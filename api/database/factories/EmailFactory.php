<?php

namespace Database\Factories;

use App\Models\Email;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Email::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $status = ['Posted','Sent','Failed'];
        return [
            'from'=>$this->faker->email,
            'to'=>$this->faker->email,
            'subject' => $this->faker->sentence,
            'text_content'=>$this->faker->paragraphs(rand(5,10)),
            'html_content'=> $this->htmlParagraph(),
            'status'=>$status[rand(0,2)]
        ];
    }

    private function htmlParagraph(): string
    {
        return '<p>'.$this->faker->paragraph(rand(3,6)).'</p>';
    }
}
