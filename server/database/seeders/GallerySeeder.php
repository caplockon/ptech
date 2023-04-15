<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GallerySeeder extends Seeder
{
    use Faker;

    protected int $ownerID = 1;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $id = DB::table('gallery_albums')->latest('id')->first('id');
        $id = $id ? $id->id : 0;
        for ($i = 0; $i < 5; $i++) {
            $this->randomAlbum([
                'id' => $curID = ++$id,
                'owner_id' => $this->ownerID
            ]);

            $size = rand(5, 15);
            for ($y = 0; $y < $size; $y++) {
                $this->randomPicture([
                    'album_id' => $curID
                ]);
            }
        }
    }

    /**
     * @param array $absoluteData
     * @return void
     */
    protected function randomAlbum(array $absoluteData = [])
    {
        DB::table('gallery_albums')->insert(array_merge([
            'uuid' => $this->getFaker()->uuid(),
            'name' => $this->getFaker()->company(),
            'description' => $this->getFaker()->paragraph(2),
            'created_at' => $this->getFaker()->dateTime(),
            'updated_at' => $this->getFaker()->dateTime(),
        ], $absoluteData));
    }

    /**
     * @param array $absoluteData
     * @return void
     */
    protected function randomPicture(array $absoluteData = [])
    {
        DB::table('gallery_pictures')->insert(array_merge([
            'uuid' => $this->getFaker()->uuid(),
            'title' => $this->getFaker()->company(),
            'description' => $this->getFaker()->paragraph(2),
            'system_path' => $this->getFaker()->imageUrl(),
            'album_id' => abs($this->getFaker()->randomNumber()),
            'created_at' => $this->getFaker()->dateTime(),
            'updated_at' => $this->getFaker()->dateTime(),
        ], $absoluteData));
    }
}
