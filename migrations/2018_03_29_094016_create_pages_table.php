<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');

            $table->string('route')->nullable();
            $table->string('slug');

            $table->string("browseable_type")->nullable();
            $table->unsignedBigInteger("browseable_id")->nullable();

            // Serialized SEO infomation
            $table->json('meta')->nullable();
            $table->json('opengraph')->nullable();
            $table->json('twitter')->nullable();

            $table->unsignedInteger('parent_id')->nullable();

            $table->unique('slug');
            $table->index('slug');

            $table->index(["browseable_type", "browseable_id"], 'browseable');

            $table->timestamps();
        });

        $routes = [
            [
                'route' => 'home',
                'slug'  => '',
                'meta'  => ['title' => 'Jobbb, the Smarter Job Board']
            ],
            [
                'route' => 'pricing',
                'slug'  => 'pricing',
                'meta'  => ['title' => 'Pricing plans']
            ],
            [
                'route' => 'openings',
                'slug'  => 'jobs',
                'meta'  => ['title' => 'Browse jobs']
            ],
            [
                'route'           => 'openings.show',
                'slug'            => 'jobs/full-stack',
                'browseable_type' => 'opening',
                'browseable_id'   => 1
            ]
        ];

        foreach ($routes as $route) {
            \Devio\Page\Page::forceCreate($route);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
