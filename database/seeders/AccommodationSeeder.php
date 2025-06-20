<?php

namespace Database\Seeders;

use App\Models\Accommodation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccommodationSeeder extends Seeder
{
    public function run(): void
    {
        $accommodations = [
            ['objective_id' => 1, 'name' => 'Introduce letter sound one by one.', 'remarks' => 'seeder generated'],
            ['objective_id' => 1, 'name' => 'Provide at least 3-5 picture and word together of each letter sound', 'remarks' => 'seeder generated'],
            ['objective_id' => 1, 'name' => 'Match picture to its beginning letter sound', 'remarks' => 'seeder generated'],
            ['objective_id' => 1, 'name' => 'Sort picture to its beginning letter sound', 'remarks' => 'seeder generated'],
            ['objective_id' => 1, 'name' => 'Variety of activities incorporated to letter sounds such sensory, fine & gross motor, worksheets, etc.', 'remarks' => 'seeder generated'],

            ['objective_id' => 2, 'name' => 'Introduce at least 10-15 action words with picture provided', 'remarks' => 'seeder generated'],
            ['objective_id' => 2, 'name' => 'Match picture to its action word', 'remarks' => 'seeder generated'],
            ['objective_id' => 2, 'name' => 'Perform the action that the teacher/facilitator given', 'remarks' => 'seeder generated'],

            ['objective_id' => 3, 'name' => 'Start with a small list of words', 'remarks' => 'seeder generated'],
            ['objective_id' => 3, 'name' => 'Make read-aloud more interactive', 'remarks' => 'seeder generated'],
            ['objective_id' => 3, 'name' => 'Engage all their senses', 'remarks' => 'seeder generated'],
            ['objective_id' => 3, 'name' => 'Master essential sight words through interactive and fun worksheets', 'remarks' => 'seeder generated'],
            ['objective_id' => 3, 'name' => 'Teach sight words through interactive and fun games', 'remarks' => 'seeder generated'],
            ['objective_id' => 3, 'name' => 'Use sensory items for writing sight words', 'remarks' => 'seeder generated'],
            ['objective_id' => 3, 'name' => 'Pair reading and writing with sight words', 'remarks' => 'seeder generated'],
            ['objective_id' => 3, 'name' => 'Use visual cues (word wall)', 'remarks' => 'seeder generated'],

            ['objective_id' => 4, 'name' => 'Provide 5-10 pictures and words together.', 'remarks' => 'seeder generated'],
            ['objective_id' => 4, 'name' => 'Say the name of each picture and let the student repeat each name.', 'remarks' => 'seeder generated'],
            ['objective_id' => 4, 'name' => 'Match each picture of things to its name/word', 'remarks' => 'seeder generated'],
            ['objective_id' => 4, 'name' => 'Trace and write each name/word of things ', 'remarks' => 'seeder generated'],
            ['objective_id' => 4, 'name' => 'Draw and color each picture of things', 'remarks' => 'seeder generated'],
            ['objective_id' => 4, 'name' => 'Variety of activities incorporated word recognition of things such sensory, fine & gross motor, games worksheets, etc.', 'remarks' => 'seeder generated'],

            ['objective_id' => 5, 'name' => 'Using tactile materials for letter formation', 'remarks' => 'seeder generated'],
            ['objective_id' => 5, 'name' => 'Incorporating visual aids for letter recognition', 'remarks' => 'seeder generated'],
            ['objective_id' => 5, 'name' => 'Engaging in auditory activities for phonemic awareness', 'remarks' => 'seeder generated'],
            ['objective_id' => 5, 'name' => 'Incorporate the tracing activity according to the interest of the learner', 'remarks' => 'seeder generated'],
            ['objective_id' => 5, 'name' => 'Implement the tracing activity every day', 'remarks' => 'seeder generated'],
            ['objective_id' => 5, 'name' => 'Provide hand-over-hand assistance when needed then gradually decrease the given assistance when independence is developing', 'remarks' => 'seeder generated'],

            ['objective_id' => 6, 'name' => 'Direct instruction and modeling: Provide explicit instruction and demonstrate proper letter formation and spacing.', 'remarks' => 'seeder generated'],
            ['objective_id' => 6, 'name' => 'Multi-sensory approaches: Engage the child in activities that involve touch, sight, and sound to reinforce learning.', 'remarks' => 'seeder generated'],
            ['objective_id' => 6, 'name' => 'Practice and repetition: Offer regular opportunities for practice to build muscle memory and improve handwriting skills.', 'remarks' => 'seeder generated'],
            ['objective_id' => 6, 'name' => 'Utilizing assistive technology or adaptive tools: Explore the use of tools such as pencil grips or adaptive writing utensils to support the child\’s needs.', 'remarks' => 'seeder generated'],
            ['objective_id' => 6, 'name' => 'Providing positive reinforcement and motivation: Celebrate small achievements, offer praise, and provide incentives to keep the child motivated and engaged', 'remarks' => 'seeder generated'],

            ['objective_id' => 7, 'name' => 'Read and sing song that has repetition', 'remarks' => 'seeder generated'],
            ['objective_id' => 7, 'name' => 'Watch videos that have color patterns', 'remarks' => 'seeder generated'],
            ['objective_id' => 7, 'name' => 'Use manipulatives as a visual representation of PATTERN IN A-B-C FORM', 'remarks' => 'seeder generated'],
            ['objective_id' => 7, 'name' => 'Copy/imitate the PATTERN IN A-B-C FORM using manipulatives', 'remarks' => 'seeder generated'],
            ['objective_id' => 7, 'name' => 'Variety of activities incorporated to pattern in A-B-C form such sensory, fine & gross motor, worksheets, etc.', 'remarks' => 'seeder generated'],

            ['objective_id' => 8, 'name' => 'Introduce basic 6 shapes (circle, triangle, oval, square, heart, rectangle)', 'remarks' => 'seeder generated'],
            ['objective_id' => 8, 'name' => 'Show and watch videos in each shape', 'remarks' => 'seeder generated'],
            ['objective_id' => 8, 'name' => 'Give 3D shapes and match to its shape representation', 'remarks' => 'seeder generated'],
            ['objective_id' => 8, 'name' => 'Shows pictures of different objects that represent to each shape', 'remarks' => 'seeder generated'],
            ['objective_id' => 8, 'name' => 'Variety of activities incorporated to shapes such sensory, fine & gross motor, worksheets, etc.', 'remarks' => 'seeder generated'],

            ['objective_id' => 9, 'name' => 'Provide different sensory activity in tactile for tracing & drawing of shapes', 'remarks' => 'seeder generated'],
            ['objective_id' => 9, 'name' => 'Watch video on how to draw different shapes', 'remarks' => 'seeder generated'],
            ['objective_id' => 9, 'name' => 'Provide paper and pen/crayon for tracing/drawing of shapes', 'remarks' => 'seeder generated'],
            ['objective_id' => 9, 'name' => 'Print out visual aid for sorting shapes according to color (3 sets)', 'remarks' => 'seeder generated'],

            ['objective_id' => 10, 'name' => 'Show video about of number song ', 'remarks' => 'seeder generated'],
            ['objective_id' => 10, 'name' => 'Provide printed materials of numbers', 'remarks' => 'seeder generated'],
            ['objective_id' => 10, 'name' => 'Use small manipulatives to form numerals', 'remarks' => 'seeder generated'],
            ['objective_id' => 10, 'name' => 'Match numerals to numerals through printed materials, and other manipulatives', 'remarks' => 'seeder generated'],

            ['objective_id' => 11, 'name' => 'Show video of numerals with number words', 'remarks' => 'seeder generated'],
            ['objective_id' => 11, 'name' => 'Spell each number words through verbal and physical', 'remarks' => 'seeder generated'],
            ['objective_id' => 11, 'name' => 'Print our large print of number words and numerals ', 'remarks' => 'seeder generated'],
            ['objective_id' => 11, 'name' => 'Variety of activities incorporated to numerals and number words such sensory, fine & gross motor, worksheets, etc.', 'remarks' => 'seeder generated'],

            ['objective_id' => 12, 'name' => 'Provide large print of number words and numerals ', 'remarks' => 'seeder generated'],
            ['objective_id' => 12, 'name' => 'Trace the numerals and number words using fingers, marker, & crayons', 'remarks' => 'seeder generated'],
            ['objective_id' => 12, 'name' => 'Trace number words and numeral in tactile form', 'remarks' => 'seeder generated'],

            ['objective_id' => 13, 'name' => 'Exercises in play dough, clay, thera putty activity such as squeezing, kneading, rolling, and pressing at least 5 minutes per session or at home', 'remarks' => 'seeder generated'],
            ['objective_id' => 13, 'name' => 'Activities that can be pulled apart and pushed together such as pop beads, duplo or blocks', 'remarks' => 'seeder generated'],
            ['objective_id' => 13, 'name' => 'Squeeze soft balls- squeeze 10 times or as many times in 1 minute', 'remarks' => 'seeder generated'],
            ['objective_id' => 13, 'name' => 'Take lids on and off incorporated to pre-learning activities', 'remarks' => 'seeder generated'],

            ['objective_id' => 14, 'name' => 'Animal walks, such as walking on hands and feet like a bear, crab walking, etc.', 'remarks' => 'seeder generated'],
            ['objective_id' => 14, 'name' => 'Stretches, push-ups, planks and yoga pose that use different positions to put weight through outstretched arms', 'remarks' => 'seeder generated'],
            ['objective_id' => 14, 'name' => 'Transferring weighted objects such as bottles with water, pillow with sand, or books', 'remarks' => 'seeder generated'],
            ['objective_id' => 14, 'name' => 'Incorporate all the activities in daily living activities or pre-learning skills', 'remarks' => 'seeder generated'],
            
            ['objective_id' => 15, 'name' => 'Include in daily routine the introducing yourself when name is called', 'remarks' => 'seeder generated'],
            ['objective_id' => 15, 'name' => 'Create social script on how to introduce oneself and what to say, repeat at least 2x a day', 'remarks' => 'seeder generated'],
            ['objective_id' => 15, 'name' => 'Incorporate to fun and engaging activity ', 'remarks' => 'seeder generated'],
            
            ['objective_id' => 16, 'name' => 'Allow student to roll call his classmates names every session', 'remarks' => 'seeder generated'],
            ['objective_id' => 16, 'name' => 'Time to time encourage to call his classmate\’s name', 'remarks' => 'seeder generated'],
            ['objective_id' => 16, 'name' => 'Provide social story about the people he is being with and read to him everyday', 'remarks' => 'seeder generated'],
            
            ['objective_id' => 17, 'name' => 'Provide play time that targets requesting such as giving their favorite toys or item to his peers', 'remarks' => 'seeder generated'],
            ['objective_id' => 17, 'name' => 'Incorporate to activities for daily living, when he needs something make sure he will use requesting sentence ', 'remarks' => 'seeder generated'],
            ['objective_id' => 17, 'name' => 'Social story about requesting and giving ', 'remarks' => 'seeder generated'],
            ['objective_id' => 17, 'name' => 'Practice social courtesy when receiving something from someone by saying “THANK YOU”', 'remarks' => 'seeder generated'],
        ];
        
        foreach($accommodations as $a)
        {
            Accommodation::firstOrCreate($a);
        }
    }
}
