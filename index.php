<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pokémon Duel Database</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
    <link rel="stylesheet" 
    href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link  rel="stylesheet"   href="font-awesome/css/fontawesome.min.css">
<script src="font-awesome/js/all.js" charset="utf-8"></script>
<link rel="stylesheet" href="style/style.css">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">


</head>

<body>
<img class='titleimg' src="img/dueldb.png">
<br>
<button  onclick="newFig()" class = 'main_btn create'>
<a>
Create a new Figure
</a>
</button>
<form method="POST" action="" id="searchform"><div class="editdiv"><input  type="text" class="input textfield" placeholder="Search for a Figure name or a creator!"><input type = "button"  class="submit2" value="Search!" ></div></form>
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
        let Read_all = () => {
            fetch("api/product/read_all.php")
            .then(response => response.json())
            .then(data => {
                    Show(data);
            }).catch(error => console.log('error is', error));
        }
        let CreateFig = (input_name, input_pass, input_user) => {
            fetch("api/product/create_fig.php?newname="+input_name+"&pas="+input_pass+"&usr="+input_user)
            .then(response => response.json())
            .then(data => {
                    Show(data);
            }).catch(error => console.log('error is', error));
        }
	
        Read_all();
        let Show = (data) => {
            let table = document.createElement('table');

            

             
             console.log(data.length);
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
                let type_1 = data[i].type_1;
                let type_2 = data[i].type_2;
                let fig_mp = data[i].mp;
				let fig_user = data[i].user;
                let fig_rarity = data[i].rarity;

                let figure_id = data[i].figure_id;
                let tr = document.createElement('tr');
                if(document.getElementById(set_id)){
                    console.log("bestaat");
                }else{
                console.log("bestaat nog niet");
                let table2 = document.createElement('table');
                table2.id = "table"+set_id;
                table2.classList.add("tables_main");
                table.border= 3;
                table2.border= 3;
                table2.style.display = "inline-block";
                table2.style.verticalAlign = "top";
                table2.style.minHeight = "200px";


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
                    mp.src="img/Duel_MP3.jpg";
                    }
                    mp.style.display = "inline-block";
                    mp.style.width = "50px";
                let mp_edit = document.createElement('span');
                    mp_edit.innerHTML = fig_mp;
					mp.classList.add("data_img");
                    mp.style.verticalAlign="middle";

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
                    rarity.style.width = "50px";
					rarity.classList.add("data_img");
                    rarity.style.display = "inline-block";
                let rarity_edit = document.createElement('span');
                    rarity_edit.innerHTML = fig_rarity;

					let user = document.createElement('h2');
					user.innerHTML = "Made by: "+fig_user+"<hr>";
					
					fig.appendChild(user);
                let type1 = document.createElement('h3');
                    type1.innerHTML += "Type 1 = ";
                
                    type1.innerHTML += type_1;



                let h2_2 = document.createElement('h2');
                h2_2.innerHTML += ability_name;
                let p = document.createElement('p');
                p.innerHTML += ability;

                fig.appendChild(h2_2);
                fig.appendChild(p);

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
                
                document.body.appendChild(table2);
                table.prepend(fig);
 
                document.body.appendChild(table2);
              let tr_top = document.createElement('tr');


             	let top_name = document.createElement('td');
             	tr_top.appendChild(top_name);
             	top_name.innerHTML = "<strong>Name</strong>";
		top_name.style.backgroundColor = "#333";
		top_name.style.color = "white";

             	let top_size = document.createElement('td');
             	tr_top.appendChild(top_size);
             	top_size.innerHTML = "<strong>Size</strong>";
		top_size.style.backgroundColor = "#333";
		top_size.style.color = "white";

           	let top_damage = document.createElement('td');
             	tr_top.appendChild(top_damage);
             	top_damage.innerHTML = "<strong>Damage</strong>";
		top_damage.style.backgroundColor = "#333";
		top_damage.style.color = "white";


            	let top_descr = document.createElement('td');
             	tr_top.appendChild(top_descr);
            	top_descr.innerHTML = "<strong>Description</strong>";
		top_descr.style.backgroundColor = "#333";
		top_descr.style.color = "white";

             	let top_color = document.createElement('td');
       	      	tr_top.appendChild(top_color);
             	top_color.innerHTML = "<strong>Color</strong>";
		top_color.style.backgroundColor = "#333";
		top_color.style.color = "white";
                table2.prepend(tr_top);
                table2.prepend(fig);

                

            
                tr.id = set_id;
                }
                document.getElementById("table"+set_id).addEventListener("click", function(){
                document.location.href = 'wheels.php?set_id='+set_id+'&name='+ figname;

                });
            /////name edit
            name_edit();
            function name_edit(){
                //span
				
                let name_edit = document.createElement('td')
                name_edit.classList.add('fig_tbl_td');
                tr.appendChild(name_edit);
                //span in td
                let output_name = document.createElement('span');
                output_name.id = 'name';
                var type = output_name.id;
                output_name.id = 'name'+i;
                name_edit.appendChild(output_name);
                output_name.innerHTML = name;
                names.push(name);
                ///jquery name
            }
            /////name edit
            /////size edit
            size_edit();
            function size_edit(){
                //span
                let size_edit = document.createElement('td');
                size_edit.classList.add('fig_tbl_td');
                tr.appendChild(size_edit);
                //span in td
                let output_size = document.createElement('span');
                output_size.id = 'size';
                var type = output_size.id;
                output_size.id = 'size'+i;
                size_edit.appendChild(output_size);
                output_size.innerHTML = size;
                sizes.push(size);
                ///jquery name
            }
            ////size edit
            /////damage edit
            damage_edit();
            function damage_edit(){
                //span
                let damage_edit = document.createElement('td');
                damage_edit.classList.add('fig_tbl_td');
                tr.appendChild(damage_edit);
                //span in td
                let output_damage = document.createElement('span');
                output_damage.id = 'damage';
                var type = output_damage.id;
                output_damage.id = 'damage'+i;
                damage_edit.appendChild(output_damage);
                damages.push(damage);

                if(color == "purple"){
					 if(damage == 1){
                        output_damage.innerHTML ="<i class='fas fa-star'></i>";
                    }
                    if(damage == 2){
                        output_damage.innerHTML ="<i class='fas fa-star'></i><i class='fas fa-star'></i>";
                    }
					 if(damage == 3){
                        output_damage.innerHTML ="<i class='fas fa-star'></i><i class='fas fa-star'></i><i class='fas fa-star'></i>";
                    }
					if(damage == 4){
                        output_damage.innerHTML ="<i class='fas fa-star'></i><i class='fas fa-star'></i><i class='fas fa-star'></i><i class='fas fa-star'></i>";
                    }
                }else{
                output_damage.innerHTML = damage;
                }
                
                ///jquery name
            }
            ////damage edit
            let output_descr = document.createElement('td');
            output_descr.classList.add('fig_tbl_td');
                tr.appendChild(output_descr);
                output_descr.innerHTML = descr;
            output_descr.style.fontSize = "10px";
            output_descr.style.width = "200px";
            /////color edit
            color_edit();
            function color_edit(){
                //span
                let color_edit = document.createElement('td')
                color_edit.classList.add('fig_tbl_td');
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
                colors.push(color);
                tr.style.backgroundColor = color;
                ///jquery name
            }
            ////damage edit
            

            
                

            ///edit jquery



          ///////

               


            document.getElementById("table"+set_id).appendChild(tr);
        }

        }
        function newFig(){
                    var newname = prompt("Please enter the Figure Name.");
                    var new_password = prompt("Please enter the password.");
					var new_user = prompt("Please enter your username.");
                    console.log(newname, new_password);
                    var input_name = newname;
                    var input_pass = new_password;
					var input_user = new_user;
                    CreateFig(input_name, input_pass, input_user);
					setTimeout(function(){ window.location='index.php'; }, 500); 
        }


	          $(document).ready(function(){
				  $(document).on('click', '.submit2', function(event) {
                      inputval = $('.input', $(this).closest(".editdiv")).val();
                       $(this).closest(".editdiv").parent(".editdiv").html(inputval);
                       console.log(inputval);
					  if(inputval != ""){
					  document.location.href = 'search.php?q='+inputval;
					  }
                     });
			  });

    </script>
    
   
<?php ?>
</body>

</html>