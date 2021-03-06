<?php
            use Illuminate\Support\Facades\Schema;
            use Illuminate\Database\Schema\Blueprint;
            use Illuminate\Database\Migrations\Migration;
            
            class CreatePaperNovelsTable extends Migration
            {
                /**
                 * Run the migrations.
                 *
                 * @return void
                 */
                public function up()
                {
                    Schema::create("paper_novels", function (Blueprint $table) {
						$table->increments('id');
						$table->integer('hero_id');
                        $table->integer('user_id');
						$table->integer('user_paper_order');
						$table->text('title')->nullable();
						$table->text('first_sentence')->nullable();
						$table->integer('viewer_count')->nullable();
						$table->integer('status');
						$table->timestamps();
						$table->softDeletes();
                    });
                }
    
                /**
                 * Reverse the migrations.
                 *
                 * @return void
                 */
                public function down()
                {
                    Schema::dropIfExists("paper_novels");
                }
            }
        