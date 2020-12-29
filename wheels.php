<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pokémon Duel Database</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" 
    href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link  rel="stylesheet"   href="font-awesome/css/fontawesome.min.css">
<script src="font-awesome/js/all.js" charset="utf-8"></script>
<link rel="stylesheet" href="style/style2.css">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">


</head>
<?php
if(isset($_GET['set_id'])){
    $set_id = $_GET['set_id'];

    } 
//////////////////////////////////////////////////
/// TO_DO ////////////////////////////////////////
/// ICONS WHEN VIEW, DATA WHEN EDIT //////////////
/// MAKE NEW FIG /////////////////////////////////
//////////////////////////////////////////////////


if (isset($_GET['name'])) {
    $figname = $_GET['name'];
}

if(isset($_GET['set_id'])){
    $set_id = $_GET['set_id'];
} 
    

$attacks = array(
    array(), //names
    array(), //colors
    array(), //segment size
    array(), //damage
);

$names = $attacks[0];
$colors = $attacks[1];
$sizes = $attacks[2];
$damages = $attacks[3];


?>

<body>
<!-- <button class = 'main_btn'>
<a href= index.php>
Go to the home page
</a>
</button> -->
<br>
<canvas id="pieChart" width="45vw" height="45vw"></canvas>
<script>
var attacks = [
    [],
    [],
    [],
    []
];
var names = attacks[0];
var colors = attacks[1];
var sizes = attacks[2];
var damages = attacks[3];
        let Read_one_set = () => {
            fetch("api/product/read_one.php?set_id=<?php echo $set_id?>")
            .then(response => response.json())
            .then(data => {
            Show(data);
            }).catch(error => console.log('error is', error));
        }
        let Update = (id, name, type) => {
            fetch("api/product/update.php?atk_id="+id+"&name="+name+"&type="+type)
            .then(response => response.json())
            .then(data => {
            Show(data);
            }).catch(error => console.log('error is', error));
        }
        Read_one_set();

        let Show = (data) => {
            if(document.getElementById("table")!== null){
                document.getElementById("table").remove();
                
            }
            let table = document.createElement('table');
            table.id = "table";
            document.body.prepend(table);
            let home_btn = document.createElement('button');
            home_btn.classList.add("main_btn");
            document.body.prepend(home_btn);
            let home_link = document.createElement('a');
            home_link.href= "index.php";
            home_link.innerHTML = "Go to the home page";
            home_btn.appendChild(home_link);

 		            let tr_top = document.createElement('tr');


             	let top_name = document.createElement('td');
             	tr_top.appendChild(top_name);
             	top_name.innerHTML = "<strong>Name</strong>";
		top_name.style.backgroundColor = "#333";
		top_name.style.color = "white";
		top_name.classList.add("res2");
             	let top_size = document.createElement('td');
             	tr_top.appendChild(top_size);
             	top_size.innerHTML = "<strong>Size</strong>";
		top_size.style.backgroundColor = "#333";
		top_size.style.color = "white";
		top_size.classList.add("res2");
           	let top_damage = document.createElement('td');
             	tr_top.appendChild(top_damage);
             	top_damage.innerHTML = "<strong>Damage</strong>";
		top_damage.style.backgroundColor = "#333";
		top_damage.style.color = "white";
		top_damage.classList.add("res2");

            	let top_descr = document.createElement('td');
             	tr_top.appendChild(top_descr);
            	top_descr.innerHTML = "<strong>Description</strong>";
		top_descr.style.backgroundColor = "#333";
		top_descr.style.color = "white";
		top_descr.classList.add("res2");
             	let top_color = document.createElement('td');
       	      	tr_top.appendChild(top_color);
             	top_color.innerHTML = "<strong>Color</strong>";
		top_color.style.backgroundColor = "#333";
		top_color.style.color = "white";
		top_color.classList.add("res2");


            for(let i=0; i<data.length; i++){
                let figname = data[i].figname;
                let ability = data[i].ability;
                let ability_name = data[i].ability_name;
                let atk_id = data[i].atk_id;         
                let name = data[i].name;
                let size = data[i].size;
                let damage = data[i].damage;
                let color = data[i].color;
                let descr = data[i].descr;
                let set_id = data[i].set_id;
                let figure_id = data[i].figure_id;
                let type_1 = data[i].type_1;
                let type_2 = data[i].type_2;
                let fig_mp = data[i].mp;
                let fig_rarity = data[i].rarity;
                var figurename = data[i].figname;
                var this_pass = data[i].password;
                var fig_id = figure_id;
                let tr = document.createElement('tr');
                if(document.getElementById(set_id)){
                    console.log("bestaat");
                }else{
                console.log("bestaat nog niet");
                let table2 = document.createElement('table');
                table2.id = "table"+set_id;
                table.classList.add("descr_view");
				table2.classList.add('view_table');
                table.border= 3;
                table2.border= 3;


                let fig = document.createElement('div');
                    console.log(figname);

                let h2 = document.createElement('h2');
                    
                    h2.innerHTML = figname;
                    h2.style.display="inline-block";
                    h2.style.marginLeft = "10px";
                    h2.style.marginRight = "10px";
                    h2.style.fontSize="30px";
					h2.classList.add("titletext");
                    h2.style.verticalAlign="middle";

                    let mp = document.createElement('img');
                    console.log(fig_mp);
                          if(fig_mp == 0){
                    mp.src = "img/Duel_MP0.jpg";
                    }else if(fig_mp == 1){
                    mp.src="img/Duel_MP1.jpg"
                    }else if(fig_mp == 2){
                    mp.src="img/Duel_MP2.jpg"
                    }else if(fig_mp == 3){
                    mp.src="img/Duel_MP3.jpg"
                    }
                    mp.style.display = "inline-block";
                let mp_edit = document.createElement('span');
                
                    mp_edit.innerHTML = fig_mp;
                    mp.style.verticalAlign="middle";
                    mp.style.width = "50px";
					mp.classList.add("data_img");

                    let rarity = document.createElement('img');
                    console.log(fig_rarity);
                          if(fig_rarity == "C"){
                    rarity.src = "img/Rarity_Common.jpg"
                    }else if(fig_rarity == "UC"){
                    rarity.src="img/Rarity_Uncommon.jpg"
                    }else if(fig_rarity == "R"){
                    rarity.src="img/Rarity_Rare.jpg"
                    }else if(fig_rarity == "EX"){
                    rarity.src="img/Rarity_EX.jpg"
                    }else if(fig_rarity === "UX"){
                    rarity.src="img/Rarity_UX.jpg"
                    }
                    rarity.style.verticalAlign="middle";
                    rarity.style.display = "inline-block";
                    rarity.style.width = "50px";
					rarity.classList.add("data_img");
                let rarity_edit = document.createElement('span');
                    rarity_edit.innerHTML = fig_rarity;



                let type1 = document.createElement('h3');
                    type1.innerHTML += "Type 1 = ";
                    type1.innerHTML += type_1;

                
                


                let h2_2 = document.createElement('h2');
                h2_2.innerHTML += ability_name;
                let p = document.createElement('p');
                p.innerHTML += ability;

                fig.appendChild(mp);
                mp.appendChild(mp_edit);


                fig.appendChild(h2);

                fig.appendChild(rarity);

                fig.appendChild(type1);
                
                if(type_2 !== "None"){
                        let type2 = document.createElement('h3');
                        
                        type2.innerHTML += "Type 2 = ";
                        type2.innerHTML += type_2;
                        type2.style.marginBottom = "10px";
                        fig.appendChild(type2);
                    }else{
                        type1.innerHTML = "Type = " + type_1;
                        type1.style.marginBottom = "10px";
                    }
                
                fig.appendChild(h2_2);
                fig.appendChild(p);
                
                
                fig.style.width = "500px";
                document.body.appendChild(table2);
                table.prepend(fig);

                

            
                tr.id = set_id;
                }
            /////name edit
            name_edit();
            function name_edit(){
                //span
                let name_edit = document.createElement('td')

                tr.appendChild(name_edit);
                //span in td
                let output_name = document.createElement('span');
                output_name.id = 'name';
                var type = output_name.id;
                output_name.id = 'name'+i;
                name_edit.appendChild(output_name);
                output_name.innerHTML = name;
				if(size != "0"){
                names.push(name);
				}
                ///jquery name 
            }
            /////name edit
            /////size edit
            var sizecount;
            size_edit();
            function size_edit(){
                //span
                let size_edit = document.createElement('td')
                tr.appendChild(size_edit);
                //span in td
                let output_size = document.createElement('span');
                output_size.id = 'size';
                var type = output_size.id;
                output_size.id = 'size'+i;
                size_edit.appendChild(output_size);
                output_size.innerHTML = size;
		if(size != "0"){
                sizes.push(size);
		}
                
                ///jquery name
            }

            ////size edit
            /////damage edit
            damage_edit();
            function damage_edit(){
                //span
                let damage_edit = document.createElement('td')
                tr.appendChild(damage_edit);
                //span in td
                let output_damage = document.createElement('span');
                output_damage.id = 'damage';
                var type = output_damage.id;
                output_damage.id = 'damage'+i;
                damage_edit.appendChild(output_damage);
		if(size != "0"){
                damages.push(damage);
		}
                if(color == "purple"){
                    if(damage == 1){
                        output_damage.innerHTML ="<i class='fas fa-star'></i>";
                    }
                    else if(damage == 2){
                        output_damage.innerHTML ="<i class='fas fa-star'></i><i class='fas fa-star'></i>";
                    }
                    else if(damage == 3){
                        output_damage.innerHTML ="<i class='fas fa-star'></i><i class='fas fa-star'></i><i class='fas fa-star'></i>";
                    }
                    else if(damage == 4){
                        output_damage.innerHTML ="<i class='fas fa-star'></i><i class='fas fa-star'></i><i class='fas fa-star'></i><i class='fas fa-star'></i>";
                    }
                    else{
                        output_damage.innerHTML = damage; 
                    }
                }else{
                output_damage.innerHTML = damage;
                }
                
                ///jquery name
            }
            ////damage edit
            let output_descr = document.createElement('td');
                tr.appendChild(output_descr);
            output_descr.innerHTML = descr;
            output_descr.style.fontSize = "10px";
            output_descr.style.width = "200px";
            var type = output_descr.id;
            output_descr.id = 'descr'+i;
                
            /////color edit
            color_edit();
            function color_edit(){
                //span
                let color_edit = document.createElement('td')
                tr.appendChild(color_edit);
                //span in td
                let output_color = document.createElement('span');
                output_color.id = 'color';
                var type = output_color.id;
                output_color.id = 'color'+i;
                color_edit.appendChild(output_color);

                
                //change good to correct + put text in table
                
                if (color=="white") {
                    color= "#fff";
                    var white = "rgb(255, 255, 255)";
                    output_color.innerHTML = "white";
                    console.log("white");
                }
                if (color=="gold") {
                    color= "#ebd448";
                    var gold = "rgb(235, 212, 72)";
                    output_color.innerHTML = "gold";
                    console.log("gold");
                }
                if (color=="purple") {
                    color= "#bf6adb";
                    var purple = "rgb(191, 106, 219)";
                    output_color.innerHTML = "purple";
                    console.log("purple");
                }
                if (color=="red") {
                    color= "#df4d4d";
                    var red = "rgb(223, 77, 77)";
                    output_color.innerHTML = "red";
                    console.log("red");
                }
                if (color=="blue") {
                    color= "#53bbe6";
                    var blue = "rgb(83, 187, 230)";
                    output_color.innerHTML = "blue";
                    console.log("blue");
                }
                ///
				if(size != "0"){
                colors.push(color);
				}
                tr.style.backgroundColor = color;
                ///jquery name
            }
            ////damage edit
            

            
                

            ///edit jquery



          ///////

               

          document.getElementById("table"+set_id).prepend(tr_top);
          document.getElementById("table"+set_id).appendChild(tr);
        }
        
        ////sizes
        var sizes_insert = [];
        for(var i = 0; i< sizes.length; i++){
            sizes_insert.push(sizes[i]);
        }
        /////colors
        var colors_insert = [];
        for(var i = 0; i< colors.length; i++){
            colors_insert.push(colors[i]);
        }
        ///names
        var names_insert = [];
        for(var i = 0; i< names.length; i++){
            names_insert.push(names[i]);
        }
        //damage
        var damages_insert = [];
        for(var i = 0; i< damages.length; i++){
            damages_insert.push(damages[i]);
        }

    /////make chart
        var data = {
    datasets: [{
        data: sizes_insert,
        borderAlign: "inner",
        borderColor: "#333",
        backgroundColor: colors_insert,
        label: names_insert, // for legend
    label2: damages_insert,
		label3: colors_insert
	// for legend
    }]

};

var pieOptions = {
  events: false,
  animation: {
    duration: 1000,
    easing: "easeInQuart",
    onComplete: function () {
            var ctx = this.chart.ctx;
            ctx.font = "3.2vw Open Sans";
            ctx.textAlign = 'center';
            ctx.textBaseline = 'bottom';

            this.data.datasets.forEach(function (dataset) {

                for (var i = 0; i < dataset.data.length; i++) {
                    var model = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._model,
                    total = dataset._meta[Object.keys(dataset._meta)[0]].total,
                    mid_radius = model.innerRadius + (model.outerRadius - model.innerRadius)/2,
                    start_angle = model.startAngle,
                    end_angle = model.endAngle,
                    mid_angle = start_angle + (end_angle - start_angle)/2;

                    var x = mid_radius * Math.cos(mid_angle);
                    var y = mid_radius * Math.sin(mid_angle);

                    ctx.fillStyle = '#333';
                    ctx.fontSize = "3.2vw";
          
                    if(dataset.backgroundColor[i]=="#bf6adb"){
                        ctx.font='3.2vw FontAwesome';

                    if(dataset.label2[i]==1){
                        ctx.fillText('\uf005', model.x + x + 0, model.y + y + window.innerWidth/30);
                    }
                    if(dataset.label2[i]==2){
                        ctx.fillText('\uf005\uf005', model.x + x + 0, model.y + y + window.innerWidth/30);
                    }
                    if(dataset.label2[i]==3){
                        ctx.fillText('\uf005\uf005\uf005', model.x + x + 0, model.y + y + window.innerWidth/30);
                    }
                    if(dataset.label2[i]==4){
                        ctx.fillText('\uf005\uf005\uf005\uf005', model.x + x + 0, model.y + y + window.innerWidth/30);
                    }else{
                
                    }
                    ctx.font = "3.2vw Open Sans";
                    ctx.fillText(dataset.label[i], model.x + x + 0, model.y + y +0);
                }else{
                    if (dataset.label2[i]==0) {
                        ctx.fillText(dataset.label[i], model.x + x + 0, model.y + y +0);
						if (dataset.label3[i] == "#fff" || dataset.label3[i] == "#ebd448" ) {
							ctx.fillText(dataset.label2[i], model.x + x + 0, model.y + y + window.innerWidth/30);
						}

                    }else{
                        ctx.fillText(dataset.label[i], model.x + x + 0, model.y + y +0);
                
						
                        ctx.fillText(dataset.label2[i], model.x + x + 0, model.y + y + window.innerWidth/30);
                }
            }
          // Display percent in another line, line break doesn't work for fillText

        }
      });
    }
  }
};

var pieChartCanvas = $("#pieChart");
var pieChart = new Chart(pieChartCanvas, {
  type: 'pie', // or doughnut
  data: data,
  options: pieOptions,
  
  borderWidth: "10px",
  borderColor: "black",
});
$(document).ready(function() {
	let br = document.createElement("br");
	document.body.appendChild(br);
    let button_edit = document.createElement("button");
    button_edit.innerHTML ="Edit this wheel!";
    button_edit.id="edit"
    document.body.appendChild(button_edit);
});  
$(document).ready(function() {
    let button_download = document.createElement("button");
    button_download.innerHTML ="Download this wheel!";
    button_download.id="download";
    button_download.style.marginLeft = "10px";
    document.body.appendChild(button_download);
});          
                $(document).ready(function() {
                    $("#edit").on("click", function() {
                        if(confirm("You need to enter a password to edit this wheel, do you want to go to the edit page?")){
                            document.location.href = 'wheels_edit.php?set_id=<?php echo $set_id?>&name=<?php echo $figname?>';
                        }
                        else{
			return false;
                        }
                    });
                });
                        

                $(document).ready(function() {
                    $("#download").on("click", function() {
                        var canvas = document.getElementById("pieChart");
            image = canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");
            var link = document.createElement('a');
            link.download = "<?php echo $_GET['name']?>.png";
            link.href = image;
            link.click();
                    });
                });
        }
        function download_image(){
            
        }
</script>

</body>

</html>