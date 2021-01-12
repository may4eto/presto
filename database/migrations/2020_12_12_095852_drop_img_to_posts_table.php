<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropImgToPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('img');
        });

        $posts = [
            [ 
                'id' => '1',
                'title' => 'HP - PC 15-dw1016nl Notebook, Intel Core i7-10510U, RAM 8 GB, SSD 256 GB, NVIDIA GeForce MX130 2 GB, HP - PC 15-dw1016nl Notebook',
                'description' => '<h1> Informazioni su questo articolo </h1>
                <ul>
                  <li> Sistema operativo: Windows 10 Home </li>
                  <li> Processore: Intel Core i7-10510U </li>
                  <li> Memoria: RAM 8 GB - SSD 256 GB </li>
                  <li> Schermo: Display 15.6&rdquo; FHD 1920 x 1080 SVA antiriflesso, retroilluminazione WLED, micro-edge, 220 nit </li>
                  <li> Caratteristiche: NVIDIA GeForce MX130 2 GB, Wi-Fi, Bluetooth, Webcam HP   TrueVision HD con microfono digitale integrato, Casse Audio, Lettore   Micro SD, USB-C, HDMI, RJ-45, HP Fast Charge </li>
                  <li> Batteria: fino a 10 ore e 15 minuti; HP Fast Charge (ricarica rapida): circa il 50% in 45 minuti </li>
                </ul>',
                'price' => '500',
                'created_at' => '2020-11-25 12:00:00',
                'updated_at' => '2020-11-25 12:00:00',
                'category_id' => '1',
                'user_id' => '1',
                'is_accepted' => '1',
            ],

            [ 
                'id' => '2',
                'title' => 'Laptop da 15,6 pollici (Intel Celeron J3455 64 bit, 8 GB di RAM DDR3, SSD da 128 GB, batteria da 10000 mAH, webcam HD, sistema operativo Windows 10 preinstallato, display IPS 1920 * 1080 FHD) Notebook',
                'description' => "<h1> Informazioni su questo articolo </h1>
                <ul>
                  <li> Il display HD da 15,6 pollici a 1920 * 1080 a vita reale offre colori intensi e testo nitido per un'esperienza visiva ricca. </li>
                  <li> Processore Intel Celeron J3355 J3455 J4105 J4155, CPU da 1,5 Ghz, fino a   2,5 Ghz. Memoria interna: DDR3 da 8 GB, Memoria da 128 GB. Durata della   batteria di grande capacità da 10000 mAh. </li>
                  <li> Rimani sempre connesso con porte USB 3.0, RJ45, HDMI, micro SD e jack per cuffie ultraveloci. </li>
                  <li> Micro HDMI ti consente di collegare il tuo laptop a un monitor esterno o una TV a grande schermo. </li>
                  <li> Ideale per l'elaborazione di testi, e-mail e streaming multimediale   (inclusi Micro Office, Netflix, Amazon Video, BBC iPlayer, ITV Player e   altro). </li>
                </ul>",
                'price' => '499,99',
                'created_at' => '2020-11-26 12:00:00',
                'updated_at' => '2020-11-26 12:00:00',
                'category_id' => '1',
                'user_id' => '1',
                'is_accepted' => '1',
            ],

            [ 
                'id' => '3',
                'title' => 'Acer KB272HLHbi Monitor FreeSync da 27"", Display VA FHD, 75 Hz, 1 ms, 16:9, VGA, HDMI, Schermo PC con Contrasto 100M:1, Lum 250 cd/m2, Zero Frame, Cavo VGA Incluso',
                'description' => "<h1> Informazioni su questo articolo </h1>
                <ul>
                  <li> RISOLUZIONE FULL HD: ogni dettaglio è estremamente chiaro grazie al display da 27'' VA Full HD (1920x1080) </li>
                  <li> TEMPO DI RISPOSTA DI 1 MS: grazie al tempo di risposta di 1 ms (VRB) le immagini sono più nitide e realistiche </li>
                  <li> PROFONDITÀ DEL COLORE A 6 BIT: la profondità del colore a 6 bit consente al display di avere maggiori sfumature di colore </li>
                  <li> DESIGN ZERO FRAME: il design ZeroFrame rende il look quasi perfetto, consentendo di vedere maggiormente il componente più importante: lo   schermo </li>
                  <li> NATURA ERGONOMICA: un buon monitor deve essere ergonomico. Con un'inclinazione di -5°-25° la comodità è garantita </li>
                </ul>",
                'price' => '567,99',
                'created_at' => '2020-11-27 12:00:00',
                'updated_at' => '2020-11-27 12:00:00',
                'category_id' => '1',
                'user_id' => '1',
                'is_accepted' => '1',
            ],

            [ 
                'id' => '4',
                'title' => 'AOC Gaming 24G2 - Monitor da 60 cm (23,8 pollici), FHD, HDMI, DisplayPort, Free-Sync, tempo di risposta 1 ms, 144 Hz, 1920 x 1080, nero/rosso',
                'description' => "<h1> Informazioni su questo articolo </h1>
                <ul>
                  <li> Display da gioco Full HD da 23,8 pollici con tecnologia FlickerFree e Low Blue Light per un divertimento illimitato. </li>
                  <li> Pannello IPS, Full HD, display opaco, 130 mm regolabile in altezza,   Headphone out, Vesa 100 x 100, piede rimovibile, telaio sottile,   altoparlante. </li>
                  <li> Luminosità/contrasto: 250 cd/m2, 1.000:1, connettori: 2 x HDMI 1,4, 1 x DisplayPort 1,2. </li>
                  <li> Garanzia del produttore: 3 anni. - I vostri diritti di garanzia legali restano intatti </li>
                  <li> Contenuto della confezione: AOC 24G2/BK Monitor 60,45 cm (23,8 pollici)   nero/rosso, cavo di alimentazione, HDMI, Displayport, CD driver, scheda   di garanzia </li>
                </ul>",
                'price' => '230,00',
                'created_at' => '2020-11-28 12:00:00',
                'updated_at' => '2020-11-28 12:00:00',
                'category_id' => '1',
                'user_id' => '1',
                'is_accepted' => '1',
            ],

            [ 
                'id' => '5',
                'title' => 'Samsung C27F396 Monitor Curvo per PC, 27" Full HD, 1920 x 1080, 60 Hz, 4 ms, Freesync, D-sub, HDMI, Nero',
                'description' => "<h1> Informazioni su questo articolo </h1>
                <ul>
                  <li> Schermo con curvatura 1800R per un alto comfort visivo </li>
                  <li> Neri scuri e dispersione della luce ridotta al minimo grazie al pannello VA e al rapporto di contrasto 3000:1 </li>
                  <li> AMD FreeSync riduce al minimo le interruzioni e i ritardi </li>
                  <li> Samsung Eco-saving consente di ridurre i consumi e limitare l'impatto ambientale </li>
                  <li> Pannello curvo ultra sottile: con il suo profilo a 11,9 mm </li>
                  <li> Risoluzione: 1920 x 1080; rapporto d'aspetto 16:9; luminosità (tipica): 250 cd/m2; frequenza di aggiornamento: 60 Hz </li>
                </ul>",
                'price' => '339',
                'created_at' => '2020-11-29 12:00:00',
                'updated_at' => '2020-11-29 12:00:00',
                'category_id' => '1',
                'user_id' => '1',
                'is_accepted' => '1',
            ],

            [ 
                'id' => '6',
                'title' => 'Lampada da Scrivania LED Protezione Degli Occhi, lampada Touch Control Pieghevole per cameretta,ufficio, con porta di ricarica USB, 10 livelli di luminosità 5 modalità di illuminazione',
                'description' => "<h1> Informazioni su questo articolo </h1>
                <ul>
                  <li> Risparmio energetico, protezione degli occhi - La lampada da tavolo a   LED non produrrà sfarfallio, la lampada da tavolo è molto adatta per la   lettura a lungo, l'apprendimento, nessun bagliore, nessuna ombra o luce   soffusa, evitando l'affaticamento degli occhi causato da luce   lampeggiante e riflessione, lascia Il comfort degli occhi, regola   l'intensità della luce per la tua età, visione e ambiente </li>
                  <li> Ampia gamma di usi- le lampade da tavolo a LED sono disponibili in 10   livelli di luminosità e 5 modalità di illuminazione per fornire livelli   di illuminazione ideali per lavoro, studio, lettura e relax. Non solo   può essere utilizzato come dispositivo di trasmissione live per telefoni   cellulari. Può anche essere usato come lampada da trucco, lampada da   comodino, ecc., Solo per usare la tua immaginazione </li>
                  <li> Controllo touch semplice - L'interruttore touch è applicato a questa   lampada da tavolo a led. La funzione di memoria significa che è   necessario impostare la modalità di luminosità solo dopo aver usato   questa lampada, che la lampada da tavolo tornerà automaticamente a   questa impostazione alla successiva accensione della lampada </li>
                  <li> Braccio flessibile - Regola la lampada all'angolazione preferita con un   braccio flessibile a 180 ° e un asse base a 90 °. Puoi scegliere il   miglior angolo di illuminazione per soddisfare le diverse esigenze. Con   lo stabilizzatore di base integrato, la base della luce di lettura   rimarrà robusta quando si regola l'angolazione, con una porta di   ricarica USB per smartphone, tablet o e-reader </li>
                  <li> Materiale in lega di alluminio - Lampada da tavolo a LED, senza piombo o   mercurio, nessuna radiazione ultravioletta o infrarossa. Il dissipatore   di calore in lega di alluminio ha una durata fino a 50.000 ore, 40   volte quella delle tradizionali lampade a incandescenza. La lampada da   tavolo ha 18 mesi di garanzia e soddisfazione del cliente al 100% </li>
                </ul>",
                'price' => '59,00',
                'created_at' => '2020-11-30 12:00:00',
                'updated_at' => '2020-11-30 12:00:00',
                'category_id' => '1',
                'user_id' => '1',
                'is_accepted' => '1',
            ],
        ];

        $user = new User();
        $user->id = '1';
        $user->name = 'Pinco Pallo';
        $user->email = 'pinco@pallo.it';
        $user->password = 'mecojoni';
        $user->save();

        foreach($posts as $post){
            $newPost = new Post();
            $newPost->id = $post['id'];
            $newPost->title = $post['title'];
            $newPost->description = $post['description'];
            $newPost->price = $post['price'];
            $newPost->created_at = $post['created_at'];
            $newPost->updated_at = $post['updated_at'];
            $newPost->is_accepted = $post['is_accepted'];
            $newPost->category_id = $post['category_id'];
            $newPost->user_id = $post['user_id'];
            $newPost->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('img');
        });
    }
}
