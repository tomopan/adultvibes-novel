<?php
use Illuminate\Database\Seeder;

    class NovelsTableSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            //Cmd: php artisan db:seed --class="NovelsTableSeeder"
            
            $faker = Faker\Factory::create("ja_JP");

            DB::table('paper_novels')->insert(
            [
                "hero_id" => 1,
                "user_id" => 2,
                "user_paper_order" => 1,
                "title" => "あきらのタイトル",
                "first_sentence" => "「テスト」と言っても、学生時代と今とでは、随分と意味が違ったように聞こえる。",
                "status" => 1,
                "created_at" => $faker->dateTime("now"),
                "updated_at" => $faker->dateTime("now")
            ]
            );
            DB::table('paper_novels')->insert(
            [
                "hero_id" => 2,
                "user_id" => 1,
                "user_paper_order" => 1,
                "title" => "すみれのタイトル",
                "first_sentence" => "私はパンケーキなど食べたくない、と言えたら幸せだった。",
                "status" => 1,
                "created_at" => $faker->dateTime("now"),
                "updated_at" => $faker->dateTime("now")
            ]
            );
            DB::table('paper_novels')->insert(
            [
                "hero_id" => 1,
                "user_id" => 2,
                "user_paper_order" => 2,
                "title" => "あきらの仮タイトル",
                "first_sentence" => "彼が後にお盆を股間にあてがう芸人になろうとは、誰も予想できなかった。",
                "status" => 0,
                "created_at" => $faker->dateTime("now"),
                "updated_at" => $faker->dateTime("now")
            ]
            );
            DB::table('paper_novels')->insert(
            [
                "hero_id" => 2,
                "user_id" => 1,
                "user_paper_order" => 2,
                "title" => "すみれの仮タイトル",
                "first_sentence" => "ラーメンみたいな名前をつけられて、呼ばれるたびに私はお腹が空く。",
                "status" => 0,
                "created_at" => $faker->dateTime("now"),
                "updated_at" => $faker->dateTime("now")
            ]
            );

        }
    }