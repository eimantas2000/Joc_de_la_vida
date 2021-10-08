<!DOCTYPE html>
<html lang="en">
<head>
<link href="css.css"rel="stylesheet" type="text/css">
</head>
<body>
    <ul>
        <a href="#" class="button" id="start"onclick="començar();">Start</a>
        <a href="#" class="button" id="stop" onclick="pause_start();">Pause</a>
        <label><font face="Comic Sans MS,Arial,Verdana">Velocitat </font><input type="range" name="velocitat" id="velocitat_entrada" value="400" min="100" max="1000" oninput="velocitat_sortida.value = velocitat_entrada.value" onchange="velocitat_slider()">
            <output name="velocitat_sortida" id="velocitat_sortida"></output>
        </label>
        <a href="#" class="button" id="guardar" onclick="Guardar();">Guardar</a>
        <div class="contador"></div>
    </ul>
    <table id="tauler"></table>
</body>
    <?php 
    //Creo l'array bidimensional segons les mides X i Y amb totes les posicions en 0
    $x= $_COOKIE['x'];
    $y= $_COOKIE['y'];
    $check =$_POST['cel'];
    print_r($check);
    $array_tauler = '[';
    
    for ($i=0;$i<$x;$i++){
        $array_tauler=$array_tauler.'[';
        for ($e=1;$e<$y;$e++){
            $array_tauler=$array_tauler.'0,';
        }
        $array_tauler=$array_tauler.'0],';
    }
    $array_tauler=$array_tauler.']';
        
        ?>
    <script>
    var valor_x=<?php echo($x)?>;
    var valor_y=<?php echo($y)?>;
    var tauler =<?php echo($array_tauler)?>;
    var array_checkbox =<?php echo json_encode($check)?>;
    var tauler1=<?php echo($array_tauler)?>;
    var start=null;
    var velocitat=0;
    var partidas=[];


//Miro les celes seleccionades i afageixo 1 
     for(var i=0;i<array_checkbox.length;i++){
        var x_y = array_checkbox[i].split(',');
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
                }else{
                    var cell1 = row.insertCell(0);
                     cell1.innerHTML = "";}
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
                }else{
                    var cell1 = row.insertCell(0);
                    cell1.style.backgroundColor = "white";
                    cell1.innerHTML = " ";}
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
    }}};

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
    var array_partida_guardar="";
    var posicio="";
    for(var i=0;i<valor_y;i++){
        for(var a=0;a<valor_x;a++){
            if(tauler1[i][a]==1){
                array_partida_guardar+=i+","+a+" ";;
    }}}
    document.cookie = nom+"="+array_partida_guardar+";max-age=86400;path=/";
    }
    </script>
</html>