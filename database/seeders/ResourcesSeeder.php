<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ResourcesSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('resources')->insert(array(
			1 => array(
				'type' => 'text',
				'path' => 'https://s3.eu-central-1.amazonaws.com/ldapps-backup/qwensh/files/qwensh-retourformulier.pdf',
				'title' => 'This displays the title',
				'copy' => 'Here comes the copy',
				'image_path' => '',
			),
			2 => array(
				'type' => 'audio',
				'path' => 'https://s3-us-west-2.amazonaws.com/s.cdpn.io/355309/Swing_Jazz_Drum.mp3',
				'title' => 'AUDIO This displays the title',
				'copy' => 'Here comes the copy',
				'image_path' => '',
			),
			3 => array(
				'type' => 'video',
				'path' => 'https://s3-us-west-2.amazonaws.com/s.cdpn.io/355309/Swing_Jazz_Drum.mp3',
				'title' => 'Video This displays the title',
				'copy' => 'Here comes the copy',
				'image_path' => 'https://www2.deloitte.com/content/dam/insights/us/articles/43123_feeling-the-heat/images/FeelingTheHeat_1440x660.jpg/_jcr_content/renditions/cq5dam.web.1440.660.jpeg',
			),
		));
	}
}


//https://www.w3schools.com/html/mov_bbb.mp4

//https://s3-us-west-2.amazonaws.com/s.cdpn.io/355309/Swing_Jazz_Drum.mp3