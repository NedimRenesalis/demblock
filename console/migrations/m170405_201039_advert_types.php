<?php

use yii\db\Migration;
use common\models\AdvertTypes;

class m170405_201039_advert_types extends Migration
{
    public function up()
    {
        $this->createTable('{{%advert_types}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'type' => $this->string()->notNull(),
            'language' => $this->string()->notNull(),
            'days' => $this->integer()->notNull(),
            'price' => $this->float()->notNull(),
            'positions' => $this->integer()->notNull()
        ]);

        // BA
        $advertType1 = new AdvertTypes();
        $advertType1->title = "Platinum Oglas 15 dana: 100KM (+ PDV 17% = 117KM)";
        $advertType1->type = "platinum";
        $advertType1->language = "BA";
        $advertType1->days = 15;
        $advertType1->price = 117;
        $advertType1->positions = 1000;
        $advertType1->save();

        $advertType2 = new AdvertTypes();
        $advertType2->title = "Platinum Oglas 30 dana: 150KM (+ PDV 17% = 175,5KM)";
        $advertType2->type = "platinum";
        $advertType2->language = "BA";
        $advertType2->days = 30;
        $advertType2->price = 175.5;
        $advertType2->positions = 1000;
        $advertType2->save();

        $advertType3 = new AdvertTypes();
        $advertType3->title = "Platinum Oglas 40 dana: 200KM (+ PDV 17% = 234KM)";
        $advertType3->type = "platinum";
        $advertType3->language = "BA";
        $advertType3->days = 40;
        $advertType3->price = 234;
        $advertType3->positions = 1000;
        $advertType3->save();

        $advertType4 = new AdvertTypes();
        $advertType4->title = "Izdvojeni poslodavac - 1 pozcija 30 dana: 70KM (+ PDV 17% = 81,9KM)";
        $advertType4->type = "premium";
        $advertType4->language = "BA";
        $advertType4->days = 30;
        $advertType4->price = 81.9;
        $advertType4->positions = 1;
        $advertType4->save();

        $advertType5 = new AdvertTypes();
        $advertType5->title = "Izdvojeni poslodavac - 2 do 5 pozicija 30 dana: 120KM (+ PDV 17% = 140,4KM)";
        $advertType5->type = "premium";
        $advertType5->language = "BA";
        $advertType5->days = 30;
        $advertType5->price = 140.4;
        $advertType5->positions = 5;
        $advertType5->save();

        $advertType6 = new AdvertTypes();
        $advertType6->title = "Izdvojeni poslodavac - 6 do 10 pozicija 30 dana: 170KM (+ PDV 17% = 198,9KM)";
        $advertType6->type = "premium";
        $advertType6->language = "BA";
        $advertType6->days = 30;
        $advertType6->price = 198.9;
        $advertType6->positions = 10;
        $advertType6->save();

        $advertType7 = new AdvertTypes();
        $advertType7->title = "Izdvojeni poslodavac - preko 10 pozicija 30 dana: 220KM (+ PDV 17% = 257,4KM)";
        $advertType7->type = "premium";
        $advertType7->language = "BA";
        $advertType7->days = 30;
        $advertType7->price = 257.4;
        $advertType7->positions = 1000;
        $advertType7->save();

        $advertType8 = new AdvertTypes();
        $advertType8->title = "Oglas unutar kategorije po poziciji - 30 dana - 35KM (+ PDV 17% = 40,95KM)";
        $advertType8->type = "normal";
        $advertType8->language = "BA";
        $advertType8->days = 30;
        $advertType8->price = 40.95;
        $advertType8->positions = 1000;
        $advertType8->save();

        // EN

        $advertType10 = new AdvertTypes();
        $advertType10->title = "Platinum Campaign - 15 days: 200 EUR (391,17 BAM)";
        $advertType10->type = "platinum";
        $advertType10->language = "EN";
        $advertType10->days = 15;
        $advertType10->price = 200;
        $advertType10->positions = 1000;
        $advertType10->save();

        $advertType11 = new AdvertTypes();
        $advertType11->title = "Platinum Campaign - 30 days: 310 EUR (606,31 BAM)";
        $advertType11->type = "platinum";
        $advertType11->language = "EN";
        $advertType11->days = 30;
        $advertType11->price = 310;
        $advertType11->positions = 1000;
        $advertType11->save();

        $advertType13 = new AdvertTypes();
        $advertType13->title = "Featured Employer - 1 posting - 30 days - 130 EUR (254,26 BAM)";
        $advertType13->type = "premium";
        $advertType13->language = "EN";
        $advertType13->days = 30;
        $advertType13->price = 130;
        $advertType13->positions = 1;
        $advertType13->save();

        $advertType14 = new AdvertTypes();
        $advertType14->title = "Featured Employer - 2 to 5 postings - 30 days - 230 EUR (449,84 BAM)";
        $advertType14->type = "premium";
        $advertType14->language = "EN";
        $advertType14->days = 30;
        $advertType14->price = 230;
        $advertType14->positions = 5;
        $advertType14->save();

        $advertType15 = new AdvertTypes();
        $advertType15->title = "Featured Employer - 6 to 10 postings - 30 days - 305 EUR (596,53 BAM)";
        $advertType15->type = "premium";
        $advertType15->language = "EN";
        $advertType15->days = 30;
        $advertType15->price = 305;
        $advertType15->positions = 10;
        $advertType15->save();

        $advertType16 = new AdvertTypes();
        $advertType16->title = "Featured Employer - more than 11 postings - 30 days - 340 EUR (664,98 BAM)";
        $advertType16->type = "premium";
        $advertType16->language = "EN";
        $advertType16->days = 30;
        $advertType16->price = 340;
        $advertType16->positions = 1000;
        $advertType16->save();

        $advertType17 = new AdvertTypes();
        $advertType17->title = "Job Post inside Cathegory - 30 days - 80 EUR (156,47 BAM)";
        $advertType17->type = "normal";
        $advertType17->language = "EN";
        $advertType17->days = 30;
        $advertType17->price = 80;
        $advertType17->positions = 1000;
        $advertType17->save();

        // DE

        $advertType18 = new AdvertTypes();
        $advertType18->title = "Platinum-Stellenanzeige - 15 Tage: 200 EUR (391,17 BAM)";
        $advertType18->type = "platinum";
        $advertType18->language = "DE";
        $advertType18->days = 15;
        $advertType18->price = 200;
        $advertType18->positions = 1000;
        $advertType18->save();

        $advertType19 = new AdvertTypes();
        $advertType19->title = "Platinum-Stellenanzeige - 30 Tage: 310 EUR (606,3 BAM)";
        $advertType19->type = "platinum";
        $advertType19->language = "DE";
        $advertType19->days = 30;
        $advertType19->price = 310;
        $advertType19->positions = 1000;
        $advertType19->save();

        $advertType20 = new AdvertTypes();
        $advertType20->title = "Hervorgeh. Arbeitgeber - 1 Stelle - 30 Tage - 130 EUR (254,26 BAM) ";
        $advertType20->type = "premium";
        $advertType20->language = "DE";
        $advertType20->days = 30;
        $advertType20->price = 130;
        $advertType20->positions = 1;
        $advertType20->save();

        $advertType21 = new AdvertTypes();
        $advertType21->title = "Hervorgeh. Arbeitgeber - 2 bis 5 Stellenanzeigen - 30 Tage - 230 EUR (449,84 BAM)";
        $advertType21->type = "premium";
        $advertType21->language = "DE";
        $advertType21->days = 30;
        $advertType21->price = 230;
        $advertType21->positions = 5;
        $advertType21->save();

        $advertType22 = new AdvertTypes();
        $advertType22->title = "Hervorgeh. Arbeitgeber - 6 bis 10 Stellenanzeigen - 30 Tage - 305 EUR (596,53 BAM)";
        $advertType22->type = "premium";
        $advertType22->language = "DE";
        $advertType22->days = 30;
        $advertType22->price = 305;
        $advertType22->positions = 10;
        $advertType22->save();

        $advertType23 = new AdvertTypes();
        $advertType23->title = "Hervorgeh. Arbeitgeber - Mehr als 11 Stellenanzeigen - 30 Tage - 340 EUR (664,98 BAM)";
        $advertType23->type = "premium";
        $advertType23->language = "DE";
        $advertType23->days = 30;
        $advertType23->price = 340;
        $advertType23->positions = 1000;
        $advertType23->save();

        $advertType24 = new AdvertTypes();
        $advertType24->title = "Stellenanzeige i. d. Liste - 30 Tage - 80 EUR (156,47 BAM) ";
        $advertType24->type = "normal";
        $advertType24->language = "DE";
        $advertType24->days = 30;
        $advertType24->price = 80;
        $advertType24->positions = 1000;
        $advertType24->save();

    }

    public function down()
    {

        $this->dropTable('{{%advert_types}}');

    }

}
