<?php 

/**
* Plugin Name: Türkiye İl ve İlçeler
* Plugin URI: https://www.yemlihakorkmaz.com/
* Description: Türkiye il ve içelerini taxanomy olarak aktarmaya yarayan eklenti
* Version: 1.0
* Author: yemlihakorkmaz
* Author URI: http://yemlihakorkmaz.com/
**/



add_action( 'admin_menu', 'kategori_aktar' );

function kategori_aktar(){
$page_title = 'Kategorileri İçi Aktar';$menu_title = 'Kategori Aktar'; $capability = 'manage_options';$menu_slug = 'kategori-aktar'; $function = 'kategori_aktar_func';$icon_url = 'dashicons-media-code'; $position = 30;add_menu_page( $page_title, $menu_title,$capability, $menu_slug,$function, $icon_url,$position );
}

function kategori_aktar_func(){
    echo '<style>
    a.islemi_yap_btn {padding: 4px 8px;font-size: 10px;color: #fff;font-weight: 500;background-color: #02a8f3;border-color: #1bb0f4;border-radius: 2px;font-family: source sans pro,sans-serif;text-transform: uppercase;letter-spacing: 1px;display: inline-block;margin-bottom: 0;text-align: center;white-space: nowrap;vertical-align: middle;touch-action: manipulation;cursor: pointer;user-select: none;text-decoration:none;background-image: none;border: 1px solid transparent;}
    .govde {padding: 25px;}
    </style>';
    
?>
<div class="wrap">
    <div class="caticeaktar">
        <div id="welcome-panel" class="welcome-panel">
            <div class="welcome-panel-content">
                <div class="welcome-panel-column-container">
                    <div class="welcome-panel-column">
                        <h3> Türkiye İl İlçe Kategori Aktarma </h3><br>Post Tipi :
                        <input type="text" id="postform" name="postform" placeholder="Örnek ad_country">
                        <div class="govde"><a href="javascript:void(0);" class="islemi_yap_btn">İşlemi Başlat</a>
                            <div id="yukleniyor"><img src="https://dev.yemlihakorkmaz.com/image/45.gif" />
                            </div>
                            <div class="bilgi"></div>
                            <br><br><br>
                            <div class="author">
                                <p>Bilgi ve destek için </p>yemlihakorkmaz@hotmail.com
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php }
function my_action_javascript() {
$ajax_nonce = wp_create_nonce( 'my-special-string' );
?>
        <script>
            jQuery(document).ready(function($) {
                var $loading = $("#yukleniyor").hide();
                $(document).ajaxStart(function() {
                    $loading.show();
                }).ajaxStop(function() {
                    $loading.hide();
                });
                $('.islemi_yap_btn').on('click', function() {
                    var data = {
                        action: 'islemiyap',
                        security: '<?php echo $ajax_nonce; ?>',
                        cat_name: $('#postform').val(),
                    };
                    $.post(ajaxurl, data, function(response) {
                        $('.bilgi').html(response);
                    });
                });
            });

        </script>
        <?php }
add_action( 'admin_footer', 'my_action_javascript' );
add_action( 'wp_ajax_islemiyap', 'islemiyap' );

function islemiyap(){global $wpdb; check_ajax_referer( 'my-special-string', 'security' );$sayi = 1; $kategorisecimi= $_POST['cat_name'];
    if (empty($kategorisecimi)) {
        echo '<div style="background-color:red; padding:15px; color:white;">Post Türünü Seçiniz</div>';} else {

    $ilveilce = array(
	array(
	"title" => "Adana",
	"districts" => array("Aladağ","Ceyhan","Çukurova","Feke","İmamoğlu","Karaisalı","Karataş","Kozan","Pozantı","Saimbeyli","Sarıçam","Seyhan","Tufanbeyli","Yumurtalık","Yüreğir")
	),
	array(
	"title" => "Adıyaman",
	"districts" => array("Adıyaman","Besni","Çelikhan","Gerger","Gölbaşı","Kâhta","Samsat","Sincik","Tut")
	),
	array(
	"title" => "Afyonkarahisar",
	"districts" => array("Afyonkarahisar","Başmakçı","Bayat","Bolvadin","Çay","Çobanlar","Dazkırı","Dinar","Emirdağ","Evciler","Hocalar","İhsaniye","İscehisar","Kızılören","Sandıklı","Sinanpaşa","Sultandağı","Şuhut")
	),
	array(
	"title" => "Ağrı",
	"districts" => array("Ağrı","Diyadin","Doğubayazıt","Eleşkirt","Hamur","Patnos","Taşlıçay","Tutak")
	),
	array(
	"title" => "Aksaray",
	"districts" => array("Ağaçören","Aksaray","Eskil","Gülağaç","Güzelyurt","Ortaköy","Sarıyahşi")
	),
	array(
	"title" => "Amasya",
	"districts" => array("Amasya","Göynücek","Gümüşhacıköy","Hamamözü","Merzifon","Suluova","Taşova")
	),
	array(
	"title" => "Ankara",
	"districts" => array("Akyurt","Altındağ","Ayaş","Balâ","Beypazarı","Çamlıdere","Çankaya","Çubuk","Elmadağ","Etimesgut","Evren","Gölbaşı","Güdül","Haymana","Kalecik","Kahramankazan","Keçiören","Kızılcahamam","Mamak","Nallıhan","Polatlı","Pursaklar","Sincan","Şereflikoçhisar","Yenimahalle")
	),
	array(
	"title" => "Antalya",
	"districts" => array("Akseki","Aksu","Alanya","Döşemealtı","Elmalı","Finike","Gazipaşa","Gündoğmuş","İbradı","Demre","Kaş","Kemer","Kepez","Konyaaltı","Korkuteli","Kumluca","Manavgat","Muratpaşa","Serik")
	),
	array(
	"title" => "Ardahan",
	"districts" => array("Ardahan","Çıldır","Damal","Göle","Hanak","Posof")
	),
	array(
	"title" => "Artvin",
	"districts" => array("Ardanuç","Arhavi","Artvin","Borçka","Hopa","Murgul","Şavşat","Yusufeli")
	),
	array(
	"title" => "Aydın",
	"districts" => array("Bozdoğan","Buharkent","Çine","Didim","Efeler","Germencik","İncirliova","Karacasu","Karpuzlu","Koçarlı","Köşk","Kuşadası","Kuyucak","Nazilli","Söke","Sultanhisar","Yenipazar")
	),
	array(
	"title" => "Balıkesir",
	"districts" => array("Altıeylül","Ayvalık","Balya","Bandırma","Bigadiç","Burhaniye","Dursunbey","Edremit","Erdek","Gömeç","Gönen","Havran","İvrindi","Karesi","Kepsut","Manyas","Marmara","Savaştepe","Sındırgı","Susurluk")
	),
	array(
	"title" => "Bartın",
	"districts" => array("Amasra","Bartın","Kurucaşile","Ulus")
	),
	array(
	"title" => "Batman",
	"districts" => array("Batman","Beşiri","Gercüş","Hasankeyf","Kozluk","Sason")
	),
	array(
	"title" => "Bayburt",
	"districts" => array("Aydıntepe","Bayburt (İl merkezi)","Demirözü")
	),
	array(
	"title" => "Bilecik",
	"districts" => array("Bilecik","Bozüyük","Gölpazarı","İnhisar","Osmaneli","Pazaryeri","Söğüt","Yenipazar")
	),
	array(
	"title" => "Bingöl",
	"districts" => array("Adaklı","Bingöl","Genç","Karlıova","Kiğı","Solhan","Yayladere","Yedisu")
	),
	array(
	"title" => "Bitlis",
	"districts" => array("Adilcevaz","Ahlat","Bitlis","Güroymak","Hizan","Mutki","Tatvan")
	),
	array(
	"title" => "Bolu",
	"districts" => array("Bolu","Dörtdivan","Gerede","Göynük","Kıbrıscık","Mengen","Mudurnu","Seben","Yeniçağa")
	),
	array(
	"title" => "Burdur",
	"districts" => array("Ağlasun","Altınyayla","Bucak","Burdur","Çavdır","Çeltikçi","Gölhisar","Karamanlı","Kemer","Tefenni","Yeşilova")
	),
	array(
	"title" => "Bursa",
	"districts" => array("Büyükorhan","Gemlik","Gürsu","Harmancık","İnegöl","İznik","Karacabey","Keles","Kestel","Mudanya","Mustafakemalpaşa","Nilüfer","Orhaneli","Orhangazi","Osmangazi","Yenişehir","Yıldırım")
	),
	array(
	"title" => "Çanakkale",
	"districts" => array("Ayvacık","Bayramiç","Biga","Bozcaada","Çan","Çanakkale","Eceabat","Ezine","Gelibolu","Gökçeada","Lapseki","Yenice")
	),
	array(
	"title" => "Çankırı",
	"districts" => array("Atkaracalar","Bayramören","Çankırı","Çerkeş","Eldivan","Ilgaz","Kızılırmak","Korgun","Kurşunlu","Orta","Şabanözü","Yapraklı")
	),
	array(
	"title" => "Çorum",
	"districts" => array("Alaca","Bayat","Boğazkale","Çorum","Dodurga","İskilip","Kargı","Laçin","Mecitözü","Oğuzlar","Ortaköy","Osmancık","Sungurlu","Uğurludağ")
	),
	array(
	"title" => "Denizli",
	"districts" => array("Acıpayam","Babadağ","Baklan","Bekilli","Beyağaç","Bozkurt","Buldan","Çal","Çameli","Çardak","Çivril","Güney","Honaz","Kale","Merkezefendi","Pamukkale","Sarayköy","Serinhisar","Tavas")
	),
	array(
	"title" => "Diyarbakır",
	"districts" => array("Bağlar","Bismil","Çermik","Çınar","Çüngüş","Dicle","Eğil","Ergani","Hani","Hazro","Kayapınar","Kocaköy","Kulp","Lice","Silvan","Sur","Yenişehir")
	),
	array(
	"title" => "Düzce",
	"districts" => array("Akçakoca","Cumayeri","Çilimli","Düzce","Gölyaka","Gümüşova","Kaynaşlı","Yığılca")
	),
	array(
	"title" => "Edirne",
	"districts" => array("Enez","Havsa","İpsala","Keşan","Lalapaşa","Meriç","Merkez","Süloğlu","Uzunköprü")
	),
	array(
	"title" => "Elâzığ",
	"districts" => array("Ağın","Alacakaya","Arıcak","Baskil","Elâzığ","Karakoçan","Keban","Kovancılar","Maden","Palu","Sivrice")
	),
	array(
	"title" => "Erzincan",
	"districts" => array("Çayırlı","Erzincan","İliç","Kemah","Kemaliye","Otlukbeli","Refahiye","Tercan","Üzümlü")
	),
	array(
	"title" => "Erzurum",
	"districts" => array("Aşkale","Aziziye","Çat","Hınıs","Horasan","İspir","Karaçoban","Karayazı","Köprüköy","Narman","Oltu","Olur","Palandöken","Pasinler","Pazaryolu","Şenkaya","Tekman","Tortum","Uzundere","Yakutiye")
	),
	array(
	"title" => "Eskişehir",
	"districts" => array("Alpu","Beylikova","Çifteler","Günyüzü","Han","İnönü","Mahmudiye","Mihalgazi","Mihalıççık","Odunpazarı","Sarıcakaya","Seyitgazi","Sivrihisar","Tepebaşı")
	),
	array(
	"title" => "Gaziantep",
	"districts" => array("Araban","İslahiye","Karkamış","Nizip","Nurdağı","Oğuzeli","Şahinbey","Şehitkâmil","Yavuzeli")
	),
	array(
	"title" => "Giresun",
	"districts" => array("Alucra","Bulancak","Çamoluk","Çanakçı","Dereli","Doğankent","Espiye","Eynesil","Giresun","Görele","Güce","Keşap","Piraziz","Şebinkarahisar","Tirebolu","Yağlıdere")
	),
	array(
	"title" => "Gümüşhane",
	"districts" => array("Gümüşhane","Kelkit","Köse","Kürtün","Şiran","Torul")
	),
	array(
	"title" => "Hakkâri",
	"districts" => array("Çukurca","Hakkâri","Şemdinli","Yüksekova")
	),
	array(
	"title" => "Hatay",
	"districts" => array("Altınözü","Antakya","Arsuz","Belen","Defne","Dörtyol","Erzin","Hassa","İskenderun","Kırıkhan","Kumlu","Payas","Reyhanlı","Samandağ","Yayladağı")
	),
	array(
	"title" => "Iğdır",
	"districts" => array("Aralık","Iğdır","Karakoyunlu","Tuzluca")
	),
	array(
	"title" => "Isparta",
	"districts" => array("Aksu","Atabey","Eğirdir","Gelendost","Gönen","Isparta","Keçiborlu","Senirkent","Sütçüler","Şarkikaraağaç","Uluborlu","Yalvaç","Yenişarbademli")
	),
	array(
	"title" => "İstanbul",
	"districts" => array("Adalar","Arnavutköy","Ataşehir","Avcılar","Bağcılar","Bahçelievler","Bakırköy","Başakşehir","Bayrampaşa","Beşiktaş","Beykoz","Beylikdüzü","Beyoğlu","Büyükçekmece","Çatalca","Çekmeköy","Esenler","Esenyurt","Eyüp","Fatih","Gaziosmanpaşa","Güngören","Kadıköy","Kağıthane","Kartal","Küçükçekmece","Maltepe","Pendik","Sancaktepe","Sarıyer","Silivri","Sultanbeyli","Sultangazi","Şile","Şişli","Tuzla","Ümraniye","Üsküdar","Zeytinburnu")
	),
	array(
	"title" => "İzmir",
	"districts" => array("Aliağa","Balçova","Bayındır","Bayraklı","Bergama","Beydağ","Bornova","Buca","Çeşme","Çiğli","Dikili","Foça","Gaziemir","Güzelbahçe","Karabağlar","Karaburun","Karşıyaka","Kemalpaşa","Kınık","Kiraz","Konak","Menderes","Menemen","Narlıdere","Ödemiş","Seferihisar","Selçuk","Tire","Torbalı","Urla")
	),
	array(
	"title" => "Kahramanmaraş",
	"districts" => array("Afşin","Andırın","Çağlayancerit","Dulkadiroğlu","Ekinözü","Elbistan","Göksun","Nurhak","Onikişubat","Pazarcık","Türkoğlu")
	),
	array(
	"title" => "Karabük",
	"districts" => array("Eflani","Eskipazar","Karabük","Ovacık","Safranbolu","Yenice")
	),
	array(
	"title" => "Karaman",
	"districts" => array("Ayrancı","Başyayla","Ermenek","Karaman","Kazımkarabekir","Sarıveliler")
	),
	array(
	"title" => "Kars",
	"districts" => array("Akyaka","Arpaçay","Digor","Kağızman","Kars","Sarıkamış","Selim","Susuz")
	),
	array(
	"title" => "Kastamonu",
	"districts" => array("Abana","Ağlı","Araç","Azdavay","Bozkurt","Cide","Çatalzeytin","Daday","Devrekani","Doğanyurt","Hanönü","İhsangazi","İnebolu","Kastamonu","Küre","Pınarbaşı","Seydiler","Şenpazar","Taşköprü","Tosya")
	),
	array(
	"title" => "Kayseri",
	"districts" => array("Akkışla","Bünyan","Develi","Felahiye","Hacılar","İncesu","Kocasinan","Melikgazi","Özvatan","Pınarbaşı","Sarıoğlan","Sarız","Talas","Tomarza","Yahyalı","Yeşilhisar")
	),
	array(
	"title" => "Kırıkkale",
	"districts" => array("Bahşılı","Balışeyh","Çelebi","Delice","Karakeçili","Keskin","Kırıkkale","Sulakyurt","Yahşihan")
	),
	array(
	"title" => "Kırklareli",
	"districts" => array("Babaeski","Demirköy","Kırklareli","Kofçaz","Lüleburgaz","Pehlivanköy","Pınarhisar","Vize")
	),
	array(
	"title" => "Kırşehir",
	"districts" => array("Akçakent","Akpınar","Boztepe","Çiçekdağı","Kaman","Kırşehir","Mucur")
	),
	array(
	"title" => "Kilis",
	"districts" => array("Elbeyli","Kilis","Musabeyli","Polateli")
	),
	array(
	"title" => "Kocaeli",
	"districts" => array("Başiskele","Çayırova","Darıca","Derince","Dilovası","Gebze","Gölcük","İzmit","Kandıra","Karamürsel","Kartepe","Körfez")
	),
	array(
	"title" => "Konya",
	"districts" => array("Ahırlı","Akören","Akşehir","Altınekin","Beyşehir","Bozkır","Cihanbeyli","Çeltik","Çumra","Derbent","Derebucak","Doğanhisar","Emirgazi","Ereğli","Güneysınır","Hadım","Halkapınar","Hüyük","Ilgın","Kadınhanı","Karapınar","Karatay","Kulu","Meram","Sarayönü","Selçuklu","Seydişehir","Taşkent","Tuzlukçu","Yalıhüyük","Yunak")
	),
	array(
	"title" => "Kütahya",
	"districts" => array("Altıntaş","Aslanapa","Çavdarhisar","Domaniç","Dumlupınar","Emet","Gediz","Hisarcık","Kütahya","Pazarlar","Şaphane","Simav","Tavşanlı")
	),
	array(
	"title" => "Malatya",
	"districts" => array("Akçadağ","Arapgir","Arguvan","Battalgazi","Darende","Doğanşehir","Doğanyol","Hekimhan","Kale","Kuluncak","Pütürge","Yazıhan","Yeşilyurt")
	),
	array(
	"title" => "Manisa",
	"districts" => array("Ahmetli","Akhisar","Alaşehir","Demirci","Gölmarmara","Gördes","Kırkağaç","Köprübaşı","Kula","Salihli","Sarıgöl","Saruhanlı","Selendi","Soma","Şehzadeler","Turgutlu","Yunusemre")
	),
	array(
	"title" => "Mardin",
	"districts" => array("Artuklu","Dargeçit","Derik","Kızıltepe","Mazıdağı","Midyat","Nusaybin","Ömerli","Savur","Yeşilli")
	),
	array(
	"title" => "Mersin",
	"districts" => array("Akdeniz","Anamur","Aydıncık","Bozyazı","Çamlıyayla","Erdemli","Gülnar","Mezitli","Mut","Silifke","Tarsus","Toroslar","Yenişehir")
	),
	array(
	"title" => "Muğla",
	"districts" => array("Bodrum","Dalaman","Datça","Fethiye","Kavaklıdere","Köyceğiz","Marmaris","Menteşe","Milas","Ortaca","Seydikemer","Ula","Yatağan")
	),
	array(
	"title" => "Muş",
	"districts" => array("Bulanık","Hasköy","Korkut","Malazgirt","Muş","Varto")
	),
	array(
	"title" => "Nevşehir",
	"districts" => array("Acıgöl","Avanos","Derinkuyu","Gülşehir","Hacıbektaş","Kozaklı","Nevşehir","Ürgüp")
	),
	array(
	"title" => "Niğde",
	"districts" => array("Altunhisar","Bor","Çamardı","Çiftlik","Niğde","Ulukışla")
	),
	array(
	"title" => "Ordu",
	"districts" => array("Akkuş","Altınordu","Aybastı","Çamaş","Çatalpınar","Çaybaşı","Fatsa","Gölköy","Gülyalı","Gürgentepe","İkizce","Kabadüz","Kabataş","Korgan","Kumru","Mesudiye","Perşembe","Ulubey","Ünye")
	),
	array(
	"title" => "Osmaniye",
	"districts" => array("Bahçe","Düziçi","Hasanbeyli","Kadirli","Osmaniye","Sumbas","Toprakkale")
	),
	array(
	"title" => "Rize",
	"districts" => array("Ardeşen","Çamlıhemşin","Çayeli","Derepazarı","Fındıklı","Güneysu","Hemşin","İkizdere","İyidere","Kalkandere","Pazar","Rize")
	),
	array(
	"title" => "Sakarya",
	"districts" => array("Adapazarı","Akyazı","Arifiye","Erenler","Ferizli","Geyve","Hendek","Karapürçek","Karasu","Kaynarca","Kocaali","Pamukova","Sapanca","Serdivan","Söğütlü","Taraklı")
	),
	array(
	"title" => "Samsun",
	"districts" => array("Alaçam","Asarcık","Atakum","Ayvacık","Bafra","Canik","Çarşamba","Havza","İlkadım","Kavak","Ladik","Ondokuzmayıs","Salıpazarı","Tekkeköy","Terme","Vezirköprü","Yakakent")
	),
	array(
	"title" => "Siirt",
	"districts" => array("Siirt","Tillo","Baykan","Eruh","Kurtalan","Pervari","Şirvan")
	),
	array(
	"title" => "Sinop",
	"districts" => array("Ayancık","Boyabat","Dikmen","Durağan","Erfelek","Gerze","Saraydüzü","Sinop","Türkeli")
	),
	array(
	"title" => "Sivas",
	"districts" => array("Akıncılar","Altınyayla","Divriği","Doğanşar","Gemerek","Gölova","Hafik","İmranlı","Kangal","Koyulhisar","Sivas","Suşehri","Şarkışla","Ulaş","Yıldızeli","Zara","Gürün")
	),
	array(
	"title" => "Şanlıurfa",
	"districts" => array("Akçakale","Birecik","Bozova","Ceylanpınar","Eyyübiye","Halfeti","Haliliye","Harran","Hilvan","Karaköprü","Siverek","Suruç","Viranşehir")
	),
	array(
	"title" => "Şırnak",
	"districts" => array("Beytüşşebap","Cizre","Güçlükonak","İdil","Silopi","Şırnak","Uludere")
	),
	array(
	"title" => "Tekirdağ",
	"districts" => array("Çerkezköy","Çorlu","Ergene","Hayrabolu","Kapaklı","Malkara","Marmara Ereğlisi","Muratlı","Saray","Süleymanpaşa","Şarköy")
	),
	array(
	"title" => "Tokat",
	"districts" => array("Almus","Artova","Başçiftlik","Erbaa","Niksar","Pazar","Reşadiye","Sulusaray","Tokat","Turhal","Yeşilyurt","Zile")
	),
	array(
	"title" => "Trabzon",
	"districts" => array("Akçaabat","Araklı","Arsin","Beşikdüzü","Çarşıbaşı","Çaykara","Dernekpazarı","Düzköy","Hayrat","Köprübaşı","Maçka","Of","Ortahisar","Sürmene","Şalpazarı","Tonya","Vakfıkebir","Yomra")
	),
	array(
	"title" => "Tunceli",
	"districts" => array("Çemişgezek","Hozat","Mazgirt","Nazımiye","Ovacık","Pertek","Pülümür","Tunceli")
	),
	array(
	"title" => "Uşak",
	"districts" => array("Banaz","Eşme","Karahallı","Sivaslı","Ulubey","Uşak")
	),
	array(
	"title" => "Van",
	"districts" => array("Bahçesaray","Başkale","Çaldıran","Çatak","Edremit","Erciş","Gevaş","Gürpınar","İpekyolu","Muradiye","Özalp","Saray","Tuşba")
	),
	array(
	"title" => "Yalova",
	"districts" => array("Altınova","Armutlu","Çınarcık","Çiftlikköy","Termal","Yalova")
	),
	array(
	"title" => "Yozgat",
	"districts" => array("Akdağmadeni","Aydıncık","Boğazlıyan","Çandır","Çayıralan","Çekerek","Kadışehri","Saraykent","Sarıkaya","Sorgun","Şefaatli","Yenifakılı","Yerköy","Yozgat")
	),
	array(
	"title" => "Zonguldak",
	"districts" => array("Alaplı","Çaycuma","Devrek","Gökçebey","Kilimli","Kozlu","Karadeniz Ereğli","Zonguldak")
	)
);
    
foreach($ilveilce as $c) {
 $my_cat = array('cat_name' => $c['title'], 'category_description' => '', 'category_nicename' => sanitize_title($c['title']), 'taxonomy' => $kategorisecimi);$term = term_exists( $c['title'], $kategorisecimi );if ( $term !== 0 && $term !== null ) {$ana= get_term_by('name', $c['title'], $kategorisecimi);$anacatid = $ana->term_id;echo '<strong style="background-color:red;padding:5px; display:block;"> '.$sayi++.' - zaten bu il var '. $c['title'].' </strong><br>'; }else {$ana = wp_insert_category($my_cat,true);echo '<strong style="background-color:green; color:white; padding:5px; display:block;">'.$sayi++.'- EKLENDİ '. $c['title'].' </strong><br>';$anacatid = $ana;  } foreach($c['districts'] as $d) {$ilcevarmi = term_exists( $d, $kategorisecimi ,$ana); $ilcevarid =$ilcevarmi['term_id'];$ilce_ekle = array('cat_name' => $d, 'category_description' => '', 'category_nicename' => sanitize_title($c['title']).'-'.sanitize_title($d), 'category_parent' => $anacatid, 'taxonomy' => $kategorisecimi,);if ( $ilcevarmi !== 0 && $ilcevarmi !== null ) {echo '<strong style="background-color:red;padding:5px; display:block;">'.$sayi++.' - zaten bu ilçe var '. $d .'</strong><br>'; }else {
wp_insert_category($ilce_ekle,true);echo '<strong style="background-color:green;padding:5px; display:block;">' .$sayi++ .'- EKLENDİ ' . $d .' </strong><br>';  } }
}  die();   }  } // islemi_yap func ?>
