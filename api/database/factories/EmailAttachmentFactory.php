<?php

namespace Database\Factories;

use App\Models\EmailAttachment;
use Illuminate\Database\Eloquent\Factories\Factory;
//use App\Models\Email;
class EmailAttachmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EmailAttachment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'attachment' => $this->faker->file(public_path('test/'), public_path('test/emails'), false),
        ];
    }
}
