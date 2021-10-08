<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css.css"rel="stylesheet" type="text/css">
    <title>Partida</title>
    <style>
           .contador1{
    display: inline;
    width: 100px;
    height: 10px;
    background-color:white;
}
.p_celules{
    display: inline;
    margin-left:10px
}
    </style>
</head>
<body>
<ul>
   <a href="#" class="button" id="start"onclick="començar();">Start</a>
   <a href="#" class="button" id="stop" onclick="pause_start();">Pause</a>
   
        <label><font face="Comic Sans MS,Arial,Verdana">Velocitat </font><input type="range" name="velocitat" id="velocitat_entrada" value="400" min="100" max="1000" oninput="velocitat_sortida.value = velocitat_entrada.value" onchange="velocitat_slider()">
            <output name="velocitat_sortida" id="velocitat_sortida"></output>
        </label>
    <a href="#" class="button" id="guardar" onclick="Guardar();">Guardar</a>
    <p class="p_celules">Cel·lules vives</p>
        <div class="contador1"id="contador_vives"></div>
        <p class="p_celules">Cel·lules mortes</p>
        <div class="contador1"id="contador_mortes"></div>
        <p class="p_celules">Cicles</p>
        <div class="contador1"id="cicles"></div>
    
</ul>
    <table id="tauler"></table>
    <a href="Formulari.html" title="Mi enlace"><img class="fletxa_enrrere"src="fletxa_enrere.png" alt="Enrere" width="auto" height="auto"></a>
<?php 

$x= $_COOKIE['x'];
$y= $_COOKIE['y'];
$array=$_COOKIE[$_GET['valor']];
?>
</body>
<script>
var posicions_partida = <?php echo json_encode($array)?>;
var valor_x=<?php echo($x)?>;
var valor_y=<?php echo($y)?>;
var array_partida = posicions_partida.split(' ');
var array_partida1=[];
var tauler=[]
var tauler1=[];
var contador=0;
var start=null;
var velocitat=100;
var partidas=[];
var celules_vives=0;
var celules_mortes=0;
var cicles=0;

for(var i=0;i<valor_y;i++){
    tauler[i]=[];
    tauler1[i]=[];
    for(var a=0;a<valor_x;a++){
        tauler[i][a]=0;
        tauler1[i][a]=0;

    }
}

for(var i=0;i<array_partida.length;i++){
        var x_y = array_partida[i].split(',');
        x_y[0]=valor_y-1-x_y[0];
        x_y[1]=valor_x-1-x_y[1];
        tauler[x_y[0]][x_y[1]]=1;
        }


var table = document.getElementById("tauler");
        table.innerHTML= "";
        for(var i=0;i<valor_y;i++){
            var table = document.getElementById("tauler");
            var row = table.insertRow(0);
            for(var a=0;a<valor_x;a++){
                if(tauler[i][a]==1){
                    var cell1 = row.insertCell(0);
                    cell1.style.backgroundColor = "black";
                    cell1.innerHTML = "";
                    celules_vives++;
                }else{
                    var cell1 = row.insertCell(0);
                     cell1.innerHTML = "";
                     celules_mortes++;
                     }
        }}

    //capturem error si surt de l'array

    this.captura = (y, x) => {
            try {
                return tauler[y][x];
            }catch {
                return 0;
            }
        };

        //Contem veins que te cada cela
        contar_veins = (row, col) => {
            let total_veins = 0;
            total_veins += this.captura(row - 1, col - 1);
            total_veins += this.captura(row - 1, col);
            total_veins += this.captura(row - 1, col + 1);
            total_veins += this.captura(row, col - 1);
            total_veins += this.captura(row, col + 1);
            total_veins += this.captura(row + 1, col - 1);
            total_veins += this.captura(row + 1, col);
            total_veins += this.captura(row + 1, col + 1);
            return total_veins;
        };

        
    //Imprimeixo la taula
    
    function imprimir_tauler() {
        this.celules_vives=0;
        this.celules_mortes=0;
        cicles++;
        var table = document.getElementById("tauler");
        table.innerHTML= "";
        for(var i=0;i<valor_y;i++){
            var table = document.getElementById("tauler");
            var row = table.insertRow(0);
            for(var a=0;a<valor_x;a++){
                if(tauler[i][a]==1){
                    var cell1 = row.insertCell(0);
                    cell1.style.backgroundColor = "black";
                    cell1.innerHTML = "";
                    celules_vives++;
                }else{
                    var cell1 = row.insertCell(0);
                    cell1.style.backgroundColor = "white";
                    cell1.innerHTML = " ";
                    celules_mortes++;
                    }
        }}};


        //Retorno 0 o 1 segons els veins que tinguin
        this.actualitzar_estat = (row, col) => {

    var total = this.contar_veins(row, col);

    if(tauler[row][col]==1){
        if(total<2){
            return 0;
        }else if(total >3){
            return 0;
        }else if(total==2){
            return tauler[row][col];
        }else if(total==3){
            return tauler[row][col];
        }
    }else if(tauler[row][col]==0){
        if(total==3){
        return 1;
    }else{
        return tauler[row][col];
    }}    
};

//Afageixo nous valors en l'array secundari
this.modificar_estat = () => {
    
for (let i = 0; i < valor_y; i++) {
    for (let j = 0; j < valor_x; j++) {
        let new_state = this.actualitzar_estat(i, j);
        tauler1[i][j] = new_state;
    }
}

for (let h = 0; h < valor_y; h++) {
    for (let b = 0; b < valor_x; b++) {
        tauler[h][b] = tauler1[h][b];
    }
}};

   //Amb aquesta funcio crido a les funciones basiques per fer funcionar el joc
            function joc() {
                if(!this.velocitat==0){
                    clearInterval(this.start);
                    començar();
                }
            this.modificar_estat();
            this.imprimir_tauler();
            this.contador1();
            };
    //Crido la funcio joc i la executo infinitament 
        function començar() {
        this.start=setInterval('joc()', this.velocitat);
        };

        function pause_start(){
   clearInterval(this.start);
 }

 function velocitat_slider(){
     this.velocitat=document.getElementById("velocitat_entrada").value;  
 }

 function Guardar(){
    
  var nom= prompt("Afageix un nom de partida");
    partidas.push();
    document.cookie = nom+"="+this.tauler1+";max-age=86400;path=/";
    }

    function contador1(){
        document.getElementById("contador_vives").innerHTML = this.celules_vives;
        document.getElementById("contador_mortes").innerHTML = this.celules_mortes;
        document.getElementById("cicles").innerHTML = this.cicles;
        
    }


</script>
    

</html>