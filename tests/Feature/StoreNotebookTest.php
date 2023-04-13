<?php

namespace Tests\Feature;

use App\Models\Notebook;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class StoreNotebookTest extends TestCase
{
    protected $notebook;

    public function dataProviderSuccess() : array
    {
        return [
            'request_1' => [
                [
                    'name' => 'name',
                    'surname' => 'surname',
                    'patronymic' => 'patronymic',
                    'campaign' => 'campaign',
                    'phone' => 'phone',
                    'email' => 'email@mail.ru',
                    'date_of_birth' => 'test_name',
                    'image' => UploadedFile::fake()->image('avatar1.jpg'),
                ]
            ],
            'request_2' => [
                [
                    'name' => 'name',
                    'surname' => 'surname',
                    'patronymic' => 'patronymic',
                    'phone' => 'phone',
                    'email' => 'email@mail.ru',
                    'date_of_birth' => 'test_name',
                ]
            ],
            'request_3' => [
                [
                    'name' => 'name',
                    'surname' => 'surname',
                    'patronymic' => 'patronymic',
                    'phone' => 'phone',
                    'email' => 'email@mail.ru',
                ]
            ],
        ];
    }

    /**
     * @dataProvider dataProviderSuccess
     * @param $request
     */
    public function testSuccess($request)
    {
        $response = $this->postJson('/api/v1/notebooks/', $request);
        $response->assertRedirect(route('notebooks.get'));

        self::assertTrue(Notebook::where('email', $request['email'])->exists());
    }

    public function dataProviderValidateErrors() : array
    {
        return [
            'only_errors' => [
                'request' => [],
                'expected_errors' => [
                    ['The surname field is required.'],
                    ['The name field is required.'],
                    ['The patronymic field is required.'],
                    ['The phone field is required.'],
                    ['The email field is required.'],
                ],
            ],
            'surname_required' => [
                'request' => [
                    'name' => 'name',
                    'patronymic' => 'patronymic',
                    'campaign' => 'campaign',
                    'phone' => 'phone',
                    'email' => 'email@mail.ru',
                    'date_of_birth' => 'test_name',
                ],
                'expected_errors' => [
                    ['The surname field is required.',],
                ],
            ],
            'surname_invalid_type' => [
                'request' => [
                    'surname' => false,
                    'name' => 'name',
                    'patronymic' => 'patronymic',
                    'campaign' => 'campaign',
                    'phone' => 'phone',
                    'email' => 'email@mail.ru',
                    'date_of_birth' => 'test_name',
                ],
                'expected_errors' => [
                    ['The surname must be a string.',],
                ],
            ],
            'name_required' => [
                'request' => [
                    'surname' => 'surname',
                    'patronymic' => 'patronymic',
                    'campaign' => 'campaign',
                    'phone' => 'phone',
                    'email' => 'email@mail.ru',
                    'date_of_birth' => 'test_name',
                ],
                'expected_errors' => [
                    ['The name field is required.'],
                ],
            ],
            'name_invalid_type' => [
                'request' => [
                    'surname' => 'surname',
                    'name' => false,
                    'patronymic' => 'patronymic',
                    'campaign' => 'campaign',
                    'phone' => 'phone',
                    'email' => 'email@mail.ru',
                    'date_of_birth' => 'test_name',
                ],
                'expected_errors' => [
                    ['The name must be a string.'],
                ],
            ],
            'patronymic_required' => [
                'request' => [
                    'surname' => 'surname',
                    'name' => 'name',
                    'campaign' => 'campaign',
                    'phone' => 'phone',
                    'email' => 'email@mail.ru',
                    'date_of_birth' => 'test_name',
                ],
                'expected_errors' => [
                    ['The patronymic field is required.'],
                ],
            ],
            'patronymic_invalid_type' => [
                'request' => [
                    'surname' => 'surname',
                    'name' => 'name',
                    'patronymic' => false,
                    'campaign' => 'campaign',
                    'phone' => 'phone',
                    'email' => 'email@mail.ru',
                    'date_of_birth' => 'test_name',
                ],
                'expected_errors' => [
                    ['The patronymic must be a string.'],
                ],
            ],
            'campaign_invalid_type' => [
                'request' => [
                    'surname' => 'surname',
                    'name' => 'name',
                    'patronymic' => 'patronymic',
                    'campaign' => false,
                    'phone' => 'phone',
                    'email' => 'email@mail.ru',
                    'date_of_birth' => 'test_name',
                ],
                'expected_errors' => [
                    ['The campaign must be a string.'],
                ],
            ],
            'phone_required' => [
                'request' => [
                    'surname' => 'surname',
                    'name' => 'name',
                    'patronymic' => 'patronymic',
                    'campaign' => 'campaign',
                    'email' => 'email@mail.ru',
                    'date_of_birth' => 'test_name',
                ],
                'expected_errors' => [
                    ['The phone field is required.'],
                ],
            ],
            'phone_invalid_type' => [
                'request' => [
                    'surname' => 'surname',
                    'name' => 'name',
                    'patronymic' => 'patronymic',
                    'campaign' => 'campaign',
                    'phone' => false,
                    'email' => 'email@mail.ru',
                    'date_of_birth' => 'test_name',
                ],
                'expected_errors' => [
                    ['The phone must be a string.'],
                ],
            ],
            'email_required' => [
                'request' => [
                    'surname' => 'surname',
                    'name' => 'name',
                    'patronymic' => 'patronymic',
                    'campaign' => 'campaign',
                    'phone' => 'phone',
                    'date_of_birth' => 'test_name',
                ],
                'expected_errors' => [
                    ['The email field is required.'],
                ],
            ],
            'email_invalid_1' => [
                'request' => [
                    'surname' => 'surname',
                    'name' => 'name',
                    'patronymic' => 'patronymic',
                    'campaign' => 'campaign',
                    'phone' => 'phone',
                    'email' => 'email',
                    'date_of_birth' => 'test_name',
                ],
                'expected_errors' => [
                    ['The email must be a valid email address.'],
                ],
            ],
            'email_invalid_2' => [
                'request' => [
                    'surname' => 'surname',
                    'name' => 'name',
                    'patronymic' => 'patronymic',
                    'campaign' => 'campaign',
                    'phone' => 'phone',
                    'email' => 'email@',
                    'date_of_birth' => 'test_name',
                ],
                'expected_errors' => [
                    ['The email must be a valid email address.'],
                ],
            ],
            'email_invalid_3' => [
                'request' => [
                    'surname' => 'surname',
                    'name' => 'name',
                    'patronymic' => 'patronymic',
                    'campaign' => 'campaign',
                    'phone' => 'phone',
                    'email' => 'email@mail',
                    'date_of_birth' => 'test_name',
                ],
                'expected_errors' => [
                    ['The email must be a valid email address.'],
                ],
            ],
            'date_of_birth_invalid_type' => [
                'request' => [
                    'surname' => 'surname',
                    'name' => 'name',
                    'patronymic' => 'patronymic',
                    'campaign' => 'campaign',
                    'phone' => 'phone',
                    'email' => 'email@mail.ru',
                    'date_of_birth' => false,
                ],
                'expected_errors' => [
                    ['The date of birth must be a string.'],
                ],
            ],
            'image_invalid_type' => [
                'request' => [
                    'surname' => 'surname',
                    'name' => 'name',
                    'patronymic' => 'patronymic',
                    'campaign' => 'campaign',
                    'phone' => 'phone',
                    'email' => 'email@mail.ru',
                    'date_of_birth' => 'date_of_birth',
                    'image' => 'image',
                ],
                'expected_errors' => [
                    ['The image must be a file.'],
                ],
            ],
        ];
    }

    /**
     * @dataProvider dataProviderValidateErrors
     * @param $request
     * @param $expectedErrors
     */
    public function testError($request, $expectedErrors)
    {
        $this->notebook = Notebook::factory()->create();

        $response = $this->postJson('/api/v1/notebooks/', $request)->json();

        self::assertTrue(isset($response['errors']));
        $errors = null;
        foreach ($response['errors'] as $item) {
            $errors[] = $item;
        }

        self::assertEquals($expectedErrors, $errors);
    }
}
