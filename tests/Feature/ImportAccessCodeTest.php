<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\AccessCode;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ImportAccessCodeTest extends TestCase
{
    public function test_can_import_new_batch_of_access_codes()
    {
        $this->loggedInAccount();

        $this->get(route('access_codes.import'))->assertOk();

        Storage::fake('uploads');

        $row1 = 'HQ,value2';
        $row2 = 'MANAGER,value3';
        $content = implode("\n", [$row1, $row2]);

        $this
            ->post(
                route('access_codes.import'),
                [
                    'access_code_file' => UploadedFile::fake()->createWithContent(
                        'test.csv',
                        $content
                    ),
                ]
            )
            ->assertSessionHas('success')
            ->assertRedirect(route('access_codes.import'));

        $this->assertDatabaseHas('access_types', ['description' => 'HQ']);
        $this->assertDatabaseHas('access_codes', ['codes' => 'value2']);
        $this->assertDatabaseHas('access_types', ['description' => 'MANAGER']);
        $this->assertDatabaseHas('access_codes', ['codes' => 'value3']);
    }

    public function test_cannot_import_access_codes_that_is_already_encoded_in_the_database()
    {
        $this->loggedInAccount();

        $this->get(route('access_codes.import'))->assertOk();

        Storage::fake('uploads');

        $row1 = 'HQ,value2';
        $row2 = 'MANAGER,value2';
        $content = implode("\n", [$row1, $row2]);

        $this
            ->post(
                route('access_codes.import'),
                [
                    'access_code_file' => UploadedFile::fake()->createWithContent(
                        'test.csv',
                        $content
                    ),
                ]
            )
            ->assertSessionHas('error')
            ->assertRedirect(route('access_codes.import'));
    }

    public function test_all_available_access_must_be_expired_when_importing_new_batch_of_access_codes()
    {
        $this->loggedInAccount();

        Storage::fake('uploads');

        $row1 = 'HQ,value1';
        $row2 = 'MANAGER,value2';
        $content = implode("\n", [$row1, $row2]);

        $this
            ->post(
                route('access_codes.import'),
                [
                    'access_code_file' => UploadedFile::fake()->createWithContent(
                        'test.csv',
                        $content
                    ),
                ]
            )
            ->assertSessionHas('success')
            ->assertRedirect(route('access_codes.import'));

        $row1 = 'HQ,value4';
        $row2 = 'MANAGER,value5';
        $content = implode("\n", [$row1, $row2]);

        $this
            ->post(
                route('access_codes.import'),
                [
                    'access_code_file' => UploadedFile::fake()->createWithContent(
                        'test.csv',
                        $content
                    ),
                ]
            )
            ->assertSessionHas('success')
            ->assertRedirect(route('access_codes.import'));

        $this->assertDatabaseHas('access_types', ['description' => 'HQ']);
        $this->assertDatabaseHas('access_codes', ['codes' => 'value1', 'status' => AccessCode::EXPIRED]);
        $this->assertDatabaseHas('access_types', ['description' => 'MANAGER']);
        $this->assertDatabaseHas('access_codes', ['codes' => 'value2', 'status' => AccessCode::EXPIRED]);
    }
}
