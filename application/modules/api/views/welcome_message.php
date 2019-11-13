<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>Create a polyline using Geolocation and Google Maps API</title>
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyAQggnzNxn0UFplcovbvhXQPsA8-zUsDk8&sensor=false&libraries=geometry"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	
    <script>
      $(document).ready(function() {
        // If the browser supports the Geolocation API
        if (typeof navigator.geolocation == "undefined") {
          $("#error1").text("Your browser doesn't support the Geolocation API");
          return;
        }
        // Save the positions' history
        var path =  [{"lat":11.1860923,"lng":78.0778515},{"lat":11.1860923,"lng":78.0778515},{"lat":11.1860923,"lng":78.0778515},{"lat":11.1860923,"lng":78.0778515},{"lat":11.1786831,"lng":78.0715586},{"lat":11.1786831,"lng":78.0715586},{"lat":11.1786831,"lng":78.0715586},{"lat":11.1786831,"lng":78.0715586},{"lat":11.1786831,"lng":78.0715586},{"lat":11.1786831,"lng":78.0715586},{"lat":11.1786831,"lng":78.0715586},{"lat":11.1786831,"lng":78.0715586},{"lat":11.1797535,"lng":78.0706045},{"lat":11.1797745,"lng":78.0705858},{"lat":11.1797967,"lng":78.070566},{"lat":11.1802958,"lng":78.0700946},{"lat":11.1815436,"lng":78.0689122},{"lat":11.1815703,"lng":78.0688869},{"lat":11.1817531,"lng":78.0687136},{"lat":11.1817531,"lng":78.0687136},{"lat":11.1817531,"lng":78.0687136},{"lat":11.1817531,"lng":78.0687136},{"lat":11.180804,"lng":78.0661975},{"lat":11.1803527,"lng":78.0653559},{"lat":11.1800125,"lng":78.0646204},{"lat":11.1796337,"lng":78.0638844},{"lat":11.1792436,"lng":78.0631297},{"lat":11.1788361,"lng":78.0623466},{"lat":11.1784707,"lng":78.0615995},{"lat":11.178156,"lng":78.0608315},{"lat":11.1778318,"lng":78.0600594},{"lat":11.1774989,"lng":78.0592199},{"lat":11.1771821,"lng":78.0583802},{"lat":11.1768302,"lng":78.0575277},{"lat":11.1764841,"lng":78.0567147},{"lat":11.1761838,"lng":78.0560014},{"lat":11.175913,"lng":78.0553013},{"lat":11.1755596,"lng":78.0545693},{"lat":11.1752333,"lng":78.0538194},{"lat":11.1748856,"lng":78.0530602},{"lat":11.1745595,"lng":78.0522547},{"lat":11.1742587,"lng":78.0514483},{"lat":11.1739376,"lng":78.050637},{"lat":11.1736662,"lng":78.049922},{"lat":11.1733425,"lng":78.049127},{"lat":11.1729551,"lng":78.0483075},{"lat":11.1725758,"lng":78.047485},{"lat":11.1721917,"lng":78.0466248},{"lat":11.171798,"lng":78.0457326},{"lat":11.1714827,"lng":78.044798},{"lat":11.1712809,"lng":78.043821},{"lat":11.1711463,"lng":78.0428024},{"lat":11.1709302,"lng":78.0417372},{"lat":11.1706376,"lng":78.0406672},{"lat":11.1702875,"lng":78.0396752},{"lat":11.1698978,"lng":78.0387283},{"lat":11.1694575,"lng":78.0377729},{"lat":11.1690309,"lng":78.0367997},{"lat":11.1686508,"lng":78.0357436},{"lat":11.1682911,"lng":78.034681},{"lat":11.1680063,"lng":78.0336419},{"lat":11.1676795,"lng":78.0326165},{"lat":11.1671954,"lng":78.0317306},{"lat":11.1665244,"lng":78.030978},{"lat":11.1656981,"lng":78.0303598},{"lat":11.1648814,"lng":78.0297307},{"lat":11.1641474,"lng":78.0290462},{"lat":11.1633963,"lng":78.0283594},{"lat":11.1626501,"lng":78.0276611},{"lat":11.1618844,"lng":78.0271117},{"lat":11.1611779,"lng":78.0267143},{"lat":11.1604878,"lng":78.0264282},{"lat":11.1598159,"lng":78.0261509},{"lat":11.1591837,"lng":78.0259062},{"lat":11.1585398,"lng":78.0256323},{"lat":11.1578849,"lng":78.0253655},{"lat":11.1572142,"lng":78.0250927},{"lat":11.1565087,"lng":78.0248288},{"lat":11.1558442,"lng":78.0246792},{"lat":11.155154,"lng":78.0246175},{"lat":11.1545163,"lng":78.0245965},{"lat":11.1539271,"lng":78.024579},{"lat":11.1533861,"lng":78.0245752},{"lat":11.1529261,"lng":78.0245789},{"lat":11.1524819,"lng":78.0245628},{"lat":11.1521214,"lng":78.024537},{"lat":11.1516871,"lng":78.0244684},{"lat":11.1511205,"lng":78.0244948},{"lat":11.1505353,"lng":78.0244977},{"lat":11.1499407,"lng":78.0244953},{"lat":11.1492977,"lng":78.0244691},{"lat":11.1486373,"lng":78.0244574},{"lat":11.147918,"lng":78.0244241},{"lat":11.1471531,"lng":78.0243008},{"lat":11.1463784,"lng":78.0240533},{"lat":11.145607,"lng":78.0235831},{"lat":11.1448629,"lng":78.0229869},{"lat":11.1440983,"lng":78.0223806},{"lat":11.1433278,"lng":78.0218267},{"lat":11.1425118,"lng":78.0213658},{"lat":11.1416528,"lng":78.0210691},{"lat":11.1407521,"lng":78.020784},{"lat":11.1398148,"lng":78.0203948},{"lat":11.1388327,"lng":78.0199721},{"lat":11.1378553,"lng":78.0195443},{"lat":11.1369064,"lng":78.0192098},{"lat":11.136229,"lng":78.0190188},{"lat":11.1357297,"lng":78.018921},{"lat":11.1351019,"lng":78.0187917},{"lat":11.1343107,"lng":78.0186154},{"lat":11.1334078,"lng":78.0183898},{"lat":11.1323991,"lng":78.0181718},{"lat":11.1313705,"lng":78.0180028},{"lat":11.1302881,"lng":78.0177959},{"lat":11.1292082,"lng":78.0174716},{"lat":11.1281593,"lng":78.0171119},{"lat":11.1271755,"lng":78.0168029},{"lat":11.126207,"lng":78.0166673},{"lat":11.1252141,"lng":78.0166845},{"lat":11.1242038,"lng":78.0168452},{"lat":11.1231494,"lng":78.0170041},{"lat":11.1220734,"lng":78.0171534},{"lat":11.1209957,"lng":78.0173027},{"lat":11.1199247,"lng":78.0174788},{"lat":11.1188174,"lng":78.0176154},{"lat":11.1176926,"lng":78.0176718},{"lat":11.1165796,"lng":78.0175065},{"lat":11.1154389,"lng":78.0174467},{"lat":11.1143539,"lng":78.0173024},{"lat":11.1132369,"lng":78.0171596},{"lat":11.112126,"lng":78.0168969},{"lat":11.11098,"lng":78.0167246},{"lat":11.1098684,"lng":78.016561},{"lat":11.1088128,"lng":78.0163949},{"lat":11.1077773,"lng":78.016153},{"lat":11.1067624,"lng":78.0158581},{"lat":11.105785,"lng":78.0153348},{"lat":11.1048692,"lng":78.0146548},{"lat":11.1040714,"lng":78.0138197},{"lat":11.1033821,"lng":78.0128418},{"lat":11.1028721,"lng":78.0117583},{"lat":11.1025154,"lng":78.0106095},{"lat":11.102274,"lng":78.0094207},{"lat":11.1019854,"lng":78.0082529},{"lat":11.1017184,"lng":78.007087},{"lat":11.1012847,"lng":78.006072},{"lat":11.1006853,"lng":78.0053905},{"lat":11.0998988,"lng":78.0049057},{"lat":11.0988992,"lng":78.0045962},{"lat":11.0978162,"lng":78.004326},{"lat":11.0967206,"lng":78.0040559},{"lat":11.0956104,"lng":78.0037894},{"lat":11.0944893,"lng":78.0035315},{"lat":11.0934034,"lng":78.0032629},{"lat":11.0923244,"lng":78.0029915},{"lat":11.091255,"lng":78.0027364},{"lat":11.0902087,"lng":78.0025465},{"lat":11.089221,"lng":78.0025105},{"lat":11.0884116,"lng":78.0026369},{"lat":11.0879269,"lng":78.0027312},{"lat":11.0874751,"lng":78.002816},{"lat":11.0868751,"lng":78.0029699},{"lat":11.0860999,"lng":78.0030836},{"lat":11.0852013,"lng":78.0031313},{"lat":11.084262,"lng":78.0031879},{"lat":11.0835094,"lng":78.0032315},{"lat":11.0830824,"lng":78.0032902},{"lat":11.0828266,"lng":78.0033114},{"lat":11.0824659,"lng":78.0034654},{"lat":11.0819561,"lng":78.0037348},{"lat":11.0813264,"lng":78.004186},{"lat":11.0806394,"lng":78.0047696},{"lat":11.079881,"lng":78.0053789},{"lat":11.079068,"lng":78.0060557},{"lat":11.0782163,"lng":78.006791},{"lat":11.0773049,"lng":78.0075243},{"lat":11.0765354,"lng":78.0080101},{"lat":11.0757516,"lng":78.0082486},{"lat":11.0747984,"lng":78.0083333},{"lat":11.0737399,"lng":78.0082903},{"lat":11.0726176,"lng":78.0082754},{"lat":11.0714769,"lng":78.0082818},{"lat":11.0704105,"lng":78.0082619},{"lat":11.0695116,"lng":78.0085825},{"lat":11.0687134,"lng":78.0091065},{"lat":11.0681266,"lng":78.0097783},{"lat":11.067597,"lng":78.0105956},{"lat":11.0670631,"lng":78.0115175},{"lat":11.0664976,"lng":78.0124705},{"lat":11.0659276,"lng":78.0134595},{"lat":11.0653712,"lng":78.0144266},{"lat":11.0648062,"lng":78.0153781},{"lat":11.0642372,"lng":78.0163469},{"lat":11.0636693,"lng":78.017303},{"lat":11.0631701,"lng":78.0182913},{"lat":11.0627539,"lng":78.0193252},{"lat":11.0623251,"lng":78.0203403},{"lat":11.0619371,"lng":78.0213409},{"lat":11.0614935,"lng":78.0223469},{"lat":11.0610516,"lng":78.0233566},{"lat":11.0605999,"lng":78.0243215},{"lat":11.0601196,"lng":78.0253151},{"lat":11.0596599,"lng":78.0263489},{"lat":11.0591618,"lng":78.0273659},{"lat":11.05865,"lng":78.0284153},{"lat":11.0581674,"lng":78.0294295},{"lat":11.057734,"lng":78.0303195},{"lat":11.0572862,"lng":78.0312265},{"lat":11.0567988,"lng":78.0321573},{"lat":11.0563217,"lng":78.0331316},{"lat":11.0558495,"lng":78.0341468},{"lat":11.0554324,"lng":78.035185},{"lat":11.0551056,"lng":78.0362606},{"lat":11.0548587,"lng":78.0373734},{"lat":11.054665,"lng":78.0384948},{"lat":11.0544901,"lng":78.0395967},{"lat":11.0543348,"lng":78.0406923},{"lat":11.0541814,"lng":78.0417817},{"lat":11.0539987,"lng":78.0428653},{"lat":11.0538726,"lng":78.04396},{"lat":11.053694,"lng":78.0450531},{"lat":11.0535261,"lng":78.0461514},{"lat":11.0533622,"lng":78.047274},{"lat":11.0531732,"lng":78.0483},{"lat":11.0530128,"lng":78.0493503},{"lat":11.0528666,"lng":78.0504148},{"lat":11.0526132,"lng":78.0513608},{"lat":11.0521304,"lng":78.0522088},{"lat":11.0514108,"lng":78.0529233},{"lat":11.0505323,"lng":78.0535476},{"lat":11.049551,"lng":78.0540925},{"lat":11.048602,"lng":78.0547294},{"lat":11.0476869,"lng":78.0553809},{"lat":11.0467561,"lng":78.0558335},{"lat":11.045811,"lng":78.0563051},{"lat":11.0448443,"lng":78.0567674},{"lat":11.0440261,"lng":78.057215},{"lat":11.04325,"lng":78.0575764},{"lat":11.0423785,"lng":78.0580198},{"lat":11.0414577,"lng":78.0585304},{"lat":11.0405393,"lng":78.0590762},{"lat":11.039591,"lng":78.0596285},{"lat":11.0385735,"lng":78.0601151},{"lat":11.0376391,"lng":78.0606454},{"lat":11.0367061,"lng":78.0610084},{"lat":11.0357158,"lng":78.061358},{"lat":11.034796,"lng":78.0619259},{"lat":11.0339694,"lng":78.0626509},{"lat":11.0331287,"lng":78.0633667},{"lat":11.0322532,"lng":78.0641034},{"lat":11.031354,"lng":78.0646947},{"lat":11.0304193,"lng":78.0649473},{"lat":11.0294021,"lng":78.065137},{"lat":11.0283072,"lng":78.065311},{"lat":11.0273156,"lng":78.0654769},{"lat":11.0263932,"lng":78.06562},{"lat":11.0254056,"lng":78.0657875},{"lat":11.0243286,"lng":78.0659581},{"lat":11.0231939,"lng":78.0661069},{"lat":11.0220986,"lng":78.0661208},{"lat":11.0209966,"lng":78.0661459},{"lat":11.0198884,"lng":78.0661822},{"lat":11.0188001,"lng":78.0661892},{"lat":11.0177464,"lng":78.0663001},{"lat":11.0167645,"lng":78.0666416},{"lat":11.0157825,"lng":78.0670179},{"lat":11.0147868,"lng":78.0674039},{"lat":11.013784,"lng":78.0678057},{"lat":11.0128057,"lng":78.0681883},{"lat":11.0119536,"lng":78.068523},{"lat":11.0111201,"lng":78.0687986},{"lat":11.0102686,"lng":78.068948},{"lat":11.0094407,"lng":78.0689353},{"lat":11.0086393,"lng":78.068788},{"lat":11.0078402,"lng":78.0686756},{"lat":11.0070298,"lng":78.0685357},{"lat":11.0061804,"lng":78.0684132},{"lat":11.0053004,"lng":78.0682714},{"lat":11.0043574,"lng":78.0681443},{"lat":11.0023874,"lng":78.067814},{"lat":11.0013693,"lng":78.0676414},{"lat":11.000344,"lng":78.0674983},{"lat":10.999286,"lng":78.0673802},{"lat":10.998228,"lng":78.0671816},{"lat":10.9971488,"lng":78.0670401},{"lat":10.9960545,"lng":78.0668578},{"lat":10.9949471,"lng":78.0667014},{"lat":10.9938569,"lng":78.0665393},{"lat":10.9927676,"lng":78.0663633},{"lat":10.9916529,"lng":78.0661764},{"lat":10.9905273,"lng":78.065996},{"lat":10.9893999,"lng":78.0658024},{"lat":10.988259,"lng":78.0656001},{"lat":10.9871064,"lng":78.0653925},{"lat":10.9859646,"lng":78.0651849},{"lat":10.9848039,"lng":78.0649764},{"lat":10.9836214,"lng":78.0648057},{"lat":10.9824673,"lng":78.0646091},{"lat":10.9813631,"lng":78.0643874},{"lat":10.9802987,"lng":78.0642132},{"lat":10.9793184,"lng":78.0640536},{"lat":10.978342,"lng":78.0638756},{"lat":10.9773055,"lng":78.0636925},{"lat":10.9763002,"lng":78.0635257},{"lat":10.9755469,"lng":78.0634057},{"lat":10.9748798,"lng":78.0633003},{"lat":10.974094,"lng":78.0631471},{"lat":10.9731839,"lng":78.0629783},{"lat":10.9722756,"lng":78.0628285},{"lat":10.9714765,"lng":78.062676},{"lat":10.9707443,"lng":78.0625932},{"lat":10.9700617,"lng":78.062498},{"lat":10.9693116,"lng":78.0623447},{"lat":10.968529,"lng":78.0621581},{"lat":10.9677165,"lng":78.0620146},{"lat":10.96691,"lng":78.0618673},{"lat":10.9660437,"lng":78.0617214},{"lat":10.9651337,"lng":78.0615536},{"lat":10.9642245,"lng":78.0613794},{"lat":10.96331,"lng":78.0612279},{"lat":10.9624037,"lng":78.0610579},{"lat":10.9614747,"lng":78.0608606},{"lat":10.9605467,"lng":78.060654},{"lat":10.9596323,"lng":78.0604551},{"lat":10.9587259,"lng":78.0602433},{"lat":10.9578004,"lng":78.0600534},{"lat":10.9568834,"lng":78.0598686},{"lat":10.9559623,"lng":78.0597079},{"lat":10.9550513,"lng":78.0595232},{"lat":10.9542193,"lng":78.0593515},{"lat":10.9533235,"lng":78.0592027},{"lat":10.9524949,"lng":78.0590302},{"lat":10.9518134,"lng":78.058908},{"lat":10.951201,"lng":78.058816},{"lat":10.9505329,"lng":78.0586539},{"lat":10.9499474,"lng":78.0585243},{"lat":10.9494159,"lng":78.0584216},{"lat":10.9487636,"lng":78.0583047},{"lat":10.9481135,"lng":78.058228},{"lat":10.9473583,"lng":78.0580945},{"lat":10.9465156,"lng":78.0579537},{"lat":10.945613,"lng":78.057815},{"lat":10.9447006,"lng":78.0576244},{"lat":10.9438491,"lng":78.0574794},{"lat":10.9425636,"lng":78.0571942},{"lat":10.9419211,"lng":78.057043},{"lat":10.9413052,"lng":78.0568778},{"lat":10.9407743,"lng":78.056772},{"lat":10.940275,"lng":78.0566825},{"lat":10.9398438,"lng":78.0565463},{"lat":10.9392096,"lng":78.0563909},{"lat":10.9385045,"lng":78.0562165},{"lat":10.9377831,"lng":78.0560731},{"lat":10.9369956,"lng":78.0558507},{"lat":10.9362929,"lng":78.055679},{"lat":10.9355418,"lng":78.0555235},{"lat":10.934763,"lng":78.0553393},{"lat":10.9340571,"lng":78.0551812},{"lat":10.9332621,"lng":78.0549857},{"lat":10.9325178,"lng":78.0548704},{"lat":10.9316058,"lng":78.0547223},{"lat":10.9307517,"lng":78.0545481},{"lat":10.9298828,"lng":78.054377},{"lat":10.9290867,"lng":78.0539618},{"lat":10.9283739,"lng":78.0534649},{"lat":10.9277014,"lng":78.0529484},{"lat":10.9270827,"lng":78.0522615},{"lat":10.9265407,"lng":78.0514444},{"lat":10.926057,"lng":78.0505635},{"lat":10.9255867,"lng":78.0497044},{"lat":10.9251813,"lng":78.0489257},{"lat":10.9247568,"lng":78.0483251},{"lat":10.9241902,"lng":78.0476674},{"lat":10.9235104,"lng":78.0469626},{"lat":10.9229001,"lng":78.0461422},{"lat":10.9221113,"lng":78.0455132},{"lat":10.9212004,"lng":78.0450541},{"lat":10.9203512,"lng":78.0446259},{"lat":10.9195052,"lng":78.044168},{"lat":10.9187871,"lng":78.0437517},{"lat":10.9174071,"lng":78.0430569},{"lat":10.9167258,"lng":78.0429106},{"lat":10.9158232,"lng":78.0427847},{"lat":10.9148816,"lng":78.0425375},{"lat":10.9140888,"lng":78.0420849},{"lat":10.9132476,"lng":78.041602},{"lat":10.9123483,"lng":78.0409875},{"lat":10.91147,"lng":78.0404404},{"lat":10.9106694,"lng":78.0398885},{"lat":10.9098449,"lng":78.0392688},{"lat":10.908998,"lng":78.0386353},{"lat":10.9081384,"lng":78.0379994},{"lat":10.9072758,"lng":78.0373685},{"lat":10.9063962,"lng":78.0368045},{"lat":10.9055006,"lng":78.0363218},{"lat":10.9046215,"lng":78.0358393},{"lat":10.9037601,"lng":78.035352},{"lat":10.9029089,"lng":78.0348717},{"lat":10.9021493,"lng":78.0343973},{"lat":10.9014179,"lng":78.0338772},{"lat":10.9008322,"lng":78.0331531},{"lat":10.9003513,"lng":78.0323003},{"lat":10.8998755,"lng":78.0314041},{"lat":10.899468,"lng":78.0307189},{"lat":10.8990733,"lng":78.0302117},{"lat":10.8986487,"lng":78.0298394},{"lat":10.8981507,"lng":78.0295629},{"lat":10.8976062,"lng":78.0292446},{"lat":10.8970224,"lng":78.0288778},{"lat":10.8964758,"lng":78.0285462},{"lat":10.8960681,"lng":78.028313},{"lat":10.8959142,"lng":78.0282426},{"lat":10.8958754,"lng":78.0282098},{"lat":10.895865,"lng":78.0282052},{"lat":10.8958659,"lng":78.0282053},{"lat":10.8958665,"lng":78.0282061},{"lat":10.8958667,"lng":78.0282061},{"lat":10.8958669,"lng":78.0282062},{"lat":10.895864,"lng":78.0282075},{"lat":10.8958636,"lng":78.028211},{"lat":10.8958645,"lng":78.0282127},{"lat":10.8958648,"lng":78.0282135},{"lat":10.8958674,"lng":78.0282145},{"lat":10.8958675,"lng":78.0282147},{"lat":10.8958675,"lng":78.0282148},{"lat":10.8958676,"lng":78.0282148},{"lat":10.8958676,"lng":78.0282148},{"lat":10.8958676,"lng":78.0282148}];
	   
	  // var path = [{"lat":13.123521,"lng":80.191368},{"lat":13.123622,"lng":80.191489},{"lat":13.123741,"lng":80.191512},{"lat":13.12386,"lng":80.191539},{"lat":13.123932,"lng":80.191654},{"lat":13.123959,"lng":80.191837},{"lat":13.123989,"lng":80.192089},{"lat":13.123985,"lng":80.192243},{"lat":13.123969,"lng":80.192394},{"lat":13.123972,"lng":80.192547},{"lat":13.123967,"lng":80.192802},{"lat":13.123965,"lng":80.192967},{"lat":13.123959,"lng":80.193158},{"lat":13.123956,"lng":80.193325},{"lat":13.123954,"lng":80.193506},{"lat":13.123954,"lng":80.193713},{"lat":13.123956,"lng":80.19393},{"lat":13.123952,"lng":80.194137},{"lat":13.123983,"lng":80.194318},{"lat":13.124106,"lng":80.194403},{"lat":13.124231,"lng":80.194478},{"lat":13.124299,"lng":80.194545},{"lat":13.124299,"lng":80.194672},{"lat":13.124279,"lng":80.194886},{"lat":13.124224,"lng":80.195105},{"lat":13.124119,"lng":80.195258},{"lat":13.12404,"lng":80.195396},{"lat":13.12398,"lng":80.195533},{"lat":13.123888,"lng":80.195662},{"lat":13.123864,"lng":80.195687},{"lat":13.123726,"lng":80.195811},{"lat":13.123607,"lng":80.195906},{"lat":13.123515,"lng":80.196018},{"lat":13.123464,"lng":80.196163},{"lat":13.123447,"lng":80.196312},{"lat":13.123568,"lng":80.196352},{"lat":13.123706,"lng":80.196251},{"lat":13.123853,"lng":80.196129},{"lat":13.123996,"lng":80.196016},{"lat":13.12413,"lng":80.195917},{"lat":13.124253,"lng":80.195818},{"lat":13.124402,"lng":80.195621},{"lat":13.124574,"lng":80.195486},{"lat":13.124723,"lng":80.195366}];


			var distance = 0;
		for(var j = 0; j < path.length - 2; j++) {
		
		var a = new google.maps.LatLng(path[j]['lat'],path[j]['lng']);
		var b = new google.maps.LatLng(path[j+1]['lat'],path[j+1]['lng']);
			distance += google.maps.geometry.spherical.computeDistanceBetween(a,b);
		//console.log(distance);
		}
	
	
		//  header("Location: http://localhost/REMS/api/Welcome/index/'"distance);
//die(); ?>
		console.log(distance);
		$('#ddd').val(distance);
		//window.location = 'http://localhost/REMS/api/Welcome/index/'+distance;
		//header("Location: http://localhost/REMS/api/Welcome/index/"+distance); 
	//location.href = 'http://localhost/REMS/api/Welcome/index/';
      
      });
    </script>
	<form name="myForm" id="myForm" target="_myFrame" action="test.php" method="POST">
  <input type="text" name="data" id="ddd" />
  <input type="submit" value="Submit" />
</form>
<?php  <script type="text/javascript">
    document.getElementById('dateForm').submit(); // SUBMIT FORM
</script>  ?>
