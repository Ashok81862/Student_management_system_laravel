<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    public $rooms = array('One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten');
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->rooms as $room){
            Room::create([
                'name' => $room
            ]);
        }
    }
}
