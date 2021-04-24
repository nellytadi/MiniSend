<?php

namespace Database\Factories;

use App\Helpers\Helper;
use App\Models\Email;
use App\Models\User;
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
        $status = (new Helper)->getStatuses();

        return [
            'from'=>$this->faker->email,
            'to'=>$this->faker->email,
            'subject' => $this->faker->sentence,
            'text_content'=>$this->faker->paragraph(rand(5,15)),
            'html_content'=> $this->htmlParagraph(),
            'status'=> $status[rand(0,2)]
        ];
    }

    public function htmlParagraph()
    {
        $paragraphs = rand(1, 5);
        $i = 0;
        $ret = "";
        while ($i < $paragraphs) {
            $ret .= "<p>" . $this->faker->paragraph(rand(2, 6)) . "</p>";
            $i++;
        }
        return $ret;
    }
}
