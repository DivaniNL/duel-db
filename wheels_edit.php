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
<link rel="stylesheet" href="style/style.css">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">


</head>
<?php
if(isset($_GET['set_id'])){
    $set_id = $_GET['set_id'];
    } 
//////////////////////////////////
/// TO_DO ////////////////////////
/// MAKE AND DELETE MOVES ////////
/// FONT SIZE OPEN SANS //////////
//////////////////////////////////


if (isset($_GET['name'])) {
    $figname = $_GET['name'];
}

if(isset($_GET['set_id'])){
    $set_id = $_GET['set_id'];
    } 
    $sessions = 'access';
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

<button class = 'main_btn'>
<a href= index.php onclick="clearCache()">
Go to the home page

</a>
</button>
<canvas id="pieChart" width="45vw" height="45vw"></canvas>
<br>
<button onclick="download_image()">
Download this Wheel!
</button>
<br><br>
<script>
   var once = false; 
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
        let Updateinfo = (figure_id, value, type) => {
            fetch("api/product/update_info.php?figure_id="+figure_id+"&name="+value+"&type="+type)
            .then(response => response.json())
            .then(data => {
            Show(data);
            }).catch(error => console.log('error is', error));
        }
        let Delete = (atk_id) => {
            fetch("api/product/delete.php?atk_id="+atk_id)
            .then(response => response.json())
            .then(data => {
            Show(data);
            }).catch(error => console.log('error is', error));
            
        }
        let Delete_figure = (figid) => {
            fetch("api/product/delete_fig.php?figure_id="+figid)
            .then(response => response.json())
            .then(data => {
            Show(data);
            }).catch(error => console.log('error is', error));
            
        }
        let Create_row = (atk_id, set_id) => {
            fetch("api/product/create_row.php?atk_id="+atk_id+"&set_id="+set_id)
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
            document.body.appendChild(table);

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


             let top_edit = document.createElement('td');
             tr_top.appendChild(top_edit);
             top_edit.innerHTML = "<strong>New Attack</strong>";
		top_edit.style.backgroundColor = "#333";
		top_edit.style.color = "white";
		top_edit.classList.add("res2");
             let top_delete = document.createElement('td');
             tr_top.appendChild(top_delete);
             top_delete.innerHTML = "<strong>Delete</strong>";
		top_delete.style.backgroundColor = "#333";
		top_delete.style.color = "white";
		top_delete.classList.add("res2");
                var totalsize = 0;
                var reduce = 0;
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
                let fig_user = data[i].user;
                let rarity = data[i].rarity;
                var figurename = data[i].figname;
                totalsize = Number(totalsize) + Number(size);
                console.log(Number(totalsize));
                diffirence_with_max = Number(totalsize) - 96 ;
                console.log(Number(diffirence_with_max));
                if(totalsize > 96){
                    
                    Update(atk_id, (size - Number(diffirence_with_max)), "size"); 
                    reduce++;

                    
                }
                if (reduce == 1) {
                    alert("Your total is now higher than 96, the last slice will be reduced");
                    document.location.href = 'wheels_edit.php?set_id='+set_id+'&name='+ figname;

                }
                if(size < 0 ){
                    size = 0;
                }


                var this_pass = data[i].password;
                var fig_id = figure_id;
                function passwordCheck(){
                    if (localStorage.getItem("access" + <?php echo $set_id?>) === null) {
                        var password = prompt("Please enter the password.");
                        if (password===this_pass){
                            
                            localStorage.setItem('access'+set_id,true);
                            window.location='wheels_edit.php?set_id='+set_id+'&name='+ figname;
            
                        } else{
alert("The password is incorrect. Please try again.");
                                window.location='wheels.php?set_id='+set_id+'&name='+ figname;

                        }
    
                        window.onload=passwordCheck;
                    }
                }
 if(!once) {
          passwordCheck();
          once = true;
      }
                
                
                let tr = document.createElement('tr');
                let atk_title = document.createElement('h2');

                if(document.getElementById(set_id)){
                    console.log("bestaat");
                }else{
                console.log("bestaat nog niet");
                let table2 = document.createElement('table');
                table2.id = "table"+set_id;
                table2.classList.add("tables");
                table.border= 3;
                table2.border= 3;


                let intro = document.createElement('div');
                    console.log(figname);

                let intro_text = document.createElement('h1');
                    intro.appendChild(intro_text);
                    document.body.appendChild(intro);
                    intro_text.innerHTML = "Welcome to the edit section!";
                    intro_text.innerHTML += "<br>";

                    let fig_info = document.createElement('h2');
                    intro.appendChild(fig_info);  
                    fig_info.innerHTML += "Figure Info";

                    
                //make table
                let fig = document.createElement('div');
                let figure_table = document.createElement('table');
                figure_table.style.width = "95%";

                fig.appendChild(figure_table); 
                figure_table.border= 3;
                //user - left
                let tr_user = document.createElement('tr');
                figure_table.appendChild(tr_user);
                td_user = document.createElement('td');
                tr_user.appendChild(td_user);
                td_user.innerHTML = "<strong>Username</strong>";
		td_user.style.backgroundColor = "#333";
		td_user.style.color = "white";
		td_user.classList.add("res2");
                //user - right
                td_user_edit = document.createElement('td');
                tr_user.appendChild(td_user_edit);
                td_user_edit.innerHTML = fig_user;
                td_user_edit.classList.add("selected");
                td_user_edit.style.width = "85%";
                //name - left
                let tr_name = document.createElement('tr');
                figure_table.appendChild(tr_name);
                td_name = document.createElement('td');
                tr_name.appendChild(td_name);
                td_name.innerHTML = "<strong>Name</strong>";
		td_name.style.backgroundColor = "#333";
		td_name.style.color = "white";
		td_name.classList.add("res2");
                //name - right
                td_name_edit = document.createElement('td');
                tr_name.appendChild(td_name_edit);
                td_name_edit.innerHTML = figname;
                td_name_edit.classList.add("selected");
                td_name_edit.style.width = "85%";
                //mp - left
                let tr_mp = document.createElement('tr');
                figure_table.appendChild(tr_mp);
                td_mp = document.createElement('td');
                tr_mp.appendChild(td_mp);
                td_mp.innerHTML = "<strong>MP</strong>";
		td_mp.style.backgroundColor = "#333";
		td_mp.style.color = "white";
		td_mp.classList.add("res2");
                //mp - right
                td_mp_edit = document.createElement('td');
                tr_mp.appendChild(td_mp_edit);
                td_mp_edit.innerHTML = fig_mp;
                td_mp_edit.classList.add("selected");
                td_mp_edit.style.width = "85%";
                //type1 - left
                let tr_t1 = document.createElement('tr');
                figure_table.appendChild(tr_t1);
                td_t1 = document.createElement('td');
                tr_t1.appendChild(td_t1);
                td_t1.innerHTML = "<strong>Type 1</strong>";
		td_t1.style.backgroundColor = "#333";
		td_t1.style.color = "white";
		td_t1.classList.add("res2");
                //type1 - right
                td_t1_edit = document.createElement('td');
                tr_t1.appendChild(td_t1_edit);
                td_t1_edit.innerHTML = type_1;
                td_t1_edit.classList.add("selected");
                td_t1_edit.style.width = "85%";
                //type2 - left
                let tr_t2 = document.createElement('tr');
                figure_table.appendChild(tr_t2);
                td_t2 = document.createElement('td');
                tr_t2.appendChild(td_t2);
                td_t2.innerHTML = "<strong>Type 2</strong>";
		td_t2.style.backgroundColor = "#333";
		td_t2.style.color = "white";
		td_t2.classList.add("res2");
                //type2 - right
                td_t2_edit = document.createElement('td');
                tr_t2.appendChild(td_t2_edit);
                td_t2_edit.innerHTML = type_2;
                td_t2_edit.classList.add("selected");
                td_t2_edit.style.width = "85%";
                //rarity - left
                let tr_rarity = document.createElement('tr');
                figure_table.appendChild(tr_rarity);
                td_rarity = document.createElement('td');
                tr_rarity.appendChild(td_rarity);
                td_rarity.innerHTML = "<strong>Rarity</strong>";
		td_rarity.style.backgroundColor = "#333";
		td_rarity.style.color = "white";
		td_rarity.classList.add("res2");
                //rarity - right
                td_rarity_edit = document.createElement('td');
                tr_rarity.appendChild(td_rarity_edit);
                td_rarity_edit.innerHTML = rarity;
                td_rarity_edit.classList.add("selected");
                td_rarity_edit.style.width = "85%";
                //a_name - left
                let tr_a_name = document.createElement('tr');
                figure_table.appendChild(tr_a_name);
                td_a_name = document.createElement('td');
                tr_a_name.appendChild(td_a_name);
                td_a_name.innerHTML = "<strong>Ability name</strong>";
		td_a_name.style.backgroundColor = "#333";
		td_a_name.style.color = "white";
		td_a_name.classList.add("res2");
                //a_name - right
                td_a_name_edit = document.createElement('td');
                tr_a_name.appendChild(td_a_name_edit);
                td_a_name_edit.innerHTML = ability_name;
                td_a_name_edit.classList.add("selected");
                td_a_name_edit.style.width = "85%";
                //a_text - left
                let tr_a_text = document.createElement('tr');
                figure_table.appendChild(tr_a_text);
                td_a_text = document.createElement('td');
                tr_a_text.appendChild(td_a_text);
                td_a_text.innerHTML = "<strong>Ability text</strong>";
		td_a_text.style.backgroundColor = "#333";
		td_a_text.style.color = "white";
		td_a_text.classList.add("res2");
                //a_text - right
                td_a_text_edit = document.createElement('td');
                tr_a_text.appendChild(td_a_text_edit);
                td_a_text_edit.innerHTML = ability;
                td_a_text_edit.classList.add("selected");
                td_a_text_edit.style.width = "85%";
					
                let tr_link = document.createElement('tr');
                figure_table.appendChild(tr_link);
                td_link = document.createElement('td');
                tr_link.appendChild(td_link);


				td_link_h2_private = document.createElement('h2');
				td_link_h2_private.classList.add("linkspan");
				td_link_h2_private.innerHTML = "<strong>The private link for editing this Figure is: <br></strong>";


				td_link_h2_public = document.createElement('h2');
				td_link_h2_public.classList.add("linkspan");
				td_link_h2_public.innerHTML = "<strong>The public link for viewing this Figure is: <br></strong>";

				td_link_a = document.createElement('a');
				td_link_a.innerHTML = "<strong>http://www.dueldb.nl/wheels_edit.php?set_id="+set_id+"&name="+ figname+"</strong>";
				td_link_a.href = "http://www.dueldb.nl/wheels_edit.php?set_id="+set_id+"&name="+ figname;

				td_link_public_a = document.createElement('a');
				td_link_public_a.innerHTML = "<strong>http://www.dueldb.nl/wheels.php?set_id="+set_id+"&name="+ figname+"</strong>";
				td_link_public_a.href = "http://www.dueldb.nl/wheels.php?set_id="+set_id+"&name="+ figname;
		
					td_link.colSpan = 2;


				td_link.appendChild(td_link_h2_public);
				td_link.appendChild(td_link_public_a);

				td_link.appendChild(td_link_h2_private);
				td_link.appendChild(td_link_a);

					
                    $(document).ready(function() {
                        $(td_t1_edit).on("click", function() {
                            var tdval, inputval, editdiv = "";
                            editdiv = $(`<form method="POST" id="type1form"><div class="editdiv"><select name="types" class="input" multiple>
                            <option value="None">None</option>
                            <option value="Bug">Bug</option>
                            <option value="Dark">Dark</option>
                            <option value="Dragon">Dragon</option>
                            <option value="Electric">Electric</option>
                            <option value="Fairy">Fairy</option>
                            <option value="Fire">Fire</option>
                            <option value="Fighting">Fighting</option>
                            <option value="Flying">Flying</option>
                            <option value="Grass">Grass</option>
                            <option value="Ghost">Ghost</option>
                            <option value="Ground">Ground</option>
                            <option value="Ice">Ice</option>
                            <option value="Normal">Normal</option>
                            <option value="Poison">Poison</option>
                            <option value="Psychic">Psychic</option>
                            <option value="Rock">Rock</option>
                            <option value="Steel">Steel</option>
                            <option value="Water">Water</option>
                            </select>
                            <input type = "submit"  name= "submitname" class="submit" ><i class="fa fa-check"></i></input></div></form>`);
                            if (!$(this).find(".input").length) {
                                tdval = $(this).text();
                                $(this).html(editdiv);
                                $('.input', $(this)).val(tdval);
                                $('.input', $(this)).focus();
                                $(document).on('click', '.submit', function(event) {
                                    inputval = $('.input', $(this).closest(".editdiv")).val();
                                    $(this).closest(".editdiv").parent(td_t1_edit).html(inputval);
                                    i++
                                    //$("#type1form").submit();
                                    Updateinfo(figure_id, inputval, "type_1");
								//setTimeout(function(){window.location='wheels_edit.php?set_id='+set_id+'&name='+ figname; }, 1500);
                                });
                            }
                        });
                    });  

                    $(document).ready(function() {
                        $(td_t2_edit).on("click", function() {
                            var tdval, inputval, editdiv = "";
                            editdiv = $(`<form method="POST" id="type2form"><div class="editdiv"><select name="types" class="input" multiple>
                            <option value="None">None</option>
                            <option value="Bug">Bug</option>
                            <option value="Dark">Dark</option>
                            <option value="Dragon">Dragon</option>
                            <option value="Electric">Electric</option>
                            <option value="Fairy">Fairy</option>
                            <option value="Fire">Fire</option>
                            <option value="Fighting">Fighting</option>
                            <option value="Flying">Flying</option>
                            <option value="Grass">Grass</option>
                            <option value="Ghost">Ghost</option>
                            <option value="Ground">Ground</option>
                            <option value="Ice">Ice</option>
                            <option value="Normal">Normal</option>
                            <option value="Poison">Poison</option>
                            <option value="Psychic">Psychic</option>
                            <option value="Rock">Rock</option>
                            <option value="Steel">Steel</option>
                            <option value="Water">Water</option>
                            </select>
                            <input type = "submit"  name= "submitname" class="submit" ><i class="fa fa-check"></i></input></div></form>`);                            if (!$(this).find(".input").length) {
                                tdval = $(this).text();
                                $(this).html(editdiv);
                                $('.input', $(this)).val(tdval);
                                $('.input', $(this)).focus();
                                $(document).on('click', '.submit', function(event) {
                                    inputval = $('.input', $(this).closest(".editdiv")).val();
                                    $(this).closest(".editdiv").parent(td_t2_edit).html(inputval);
                                    i++
                                    //$("#type2form").submit();
                                    Updateinfo(figure_id, inputval, "type_2");
								//setTimeout(function(){window.location='wheels_edit.php?set_id='+set_id+'&name='+ figname; }, 500);
                                });
                            }
                        });
                    }); 
                $(document).ready(function() {
                        $(td_rarity_edit).on("click", function() {
                            var tdval, inputval, editdiv = "";
                            editdiv = $(`<form method="POST" id="rarityform"><div class="editdiv"><select name="types" class="input" multiple>
                            <option value="C">Common</option>
                            <option value="UC">Uncommon</option>
                            <option value="R">Rare</option>
                            <option value="EX">EX</option>
                            <option value="UX">UX</option>
                           
                            </select>
                            <input type = "submit"  name= "submitname" class="submit" ><i class="fa fa-check"></i></input></div></form>`);
                            if (!$(this).find(".input").length) {
                                tdval = $(this).text();
                                $(this).html(editdiv);
                                $('.input', $(this)).val(tdval);
                                $('.input', $(this)).focus();
                                $(document).on('click', '.submit', function(event) {
                                    inputval = $('.input', $(this).closest(".editdiv")).val();
                                    $(this).closest(".editdiv").parent(td_rarity_edit).html(inputval);
                                    i++
                                    //$("#rarityform").submit();
                                    Updateinfo(figure_id, inputval, "rarity");
								//setTimeout(function(){window.location='wheels_edit.php?set_id='+set_id+'&name='+ figname; }, 500);
                                });
                            }
                        });
                    });  
                
                    $(document).ready(function() {
                        $(td_mp_edit).on("click", function() {
                            var tdval, inputval, editdiv = "";
                            editdiv = $(`<form method="POST" id="mpform"><div class="editdiv"><select name="types" class="input" multiple>
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                           
                            </select>
                            
                            <input type = "submit"  name= "submitname" class="submit" ><i class="fa fa-check"></i></input></div></form>`);
                            if (!$(this).find(".input").length) {
                                tdval = $(this).text();
                                $(this).html(editdiv);
                                $('.input', $(this)).val(tdval);
                                $('.input', $(this)).focus();
                                $(document).on('click', '.submit', function(event) {
                                    inputval = $('.input', $(this).closest(".editdiv")).val();
                                    $(this).closest(".editdiv").parent(td_mp_edit).html(inputval);
                                    i++
                                    //$("#mpform").submit();
                                    Updateinfo(figure_id, inputval, "mp");
								//setTimeout(function(){window.location='wheels_edit.php?set_id='+set_id+'&name='+ figname; }, 500);
                                });
                            }
                        });
                    }); 

                fig.style.width = "500px";
                document.body.appendChild(table2);
                table.prepend(fig);
                table.prepend(intro);

                

                tr.id = set_id;  
                $(document).ready(function() {
                $(td_a_name_edit).on("click", function() {
                        var tdval, inputval, editdiv = "";
                        editdiv = $('<form method="POST" id="abilitynameform"><div class="editdiv"><textarea rows="6" cols="60" class="input"></textarea><input type = "submit"  name= "submitname" class="submit" ><i class="fa fa-check"></i></input></div></form>');
                        if (!$(this).find(".input").length) {
                            tdval = $(this).text();
                            $(this).html(editdiv);
                            $('.input', $(this)).val(tdval);
                            $('.input', $(this)).focus();
                            $(document).on('click', '.submit', function(event) {
                                inputval = $('.input', $(this).closest(".editdiv")).val();
                                $(this).closest(".editdiv").parent(td_a_name_edit).html(inputval);
                                i++
                                //$("#abilitynameform").submit();
                                Updateinfo(figure_id, inputval, "ability_name");
								//setTimeout(function(){window.location='wheels_edit.php?set_id='+set_id+'&name='+ figname; }, 500);
                            });
                        }
                    });
                });   
		$(document).ready(function() {
                    $(td_user_edit).on("click", function() {
                            var tdval, inputval, editdiv = "";
                            editdiv = $('<form method="POST" id="userform"><div class="editdiv"><input type="text" class="input"></textarea><input type = "submit"  name= "submitname" class="submit" ><i class="fa fa-check"></i></input></div></form>');
                            if (!$(this).find(".input").length) {
                                tdval = $(this).text();
                                $(this).html(editdiv);
                                $('.input', $(this)).val(tdval);
                                $('.input', $(this)).focus();
                                $(document).on('click', '.submit', function(event) {
                                    inputval = $('.input', $(this).closest(".editdiv")).val();
                                    $(this).closest(".editdiv").parent(td_user_edit).html(inputval);
                                    i++
                                    //$("#userform").submit();
                                    Updateinfo(figure_id, inputval, "user");
								//setTimeout(function(){window.location='wheels_edit.php?set_id='+set_id+'&name='+ figname; }, 500);
                                });
                            }
                    });
                }); 
                $(document).ready(function() {
                    $(td_name_edit).on("click", function() {
                            var tdval, inputval, editdiv = "";
                            editdiv = $('<form method="POST" id="figform"><div class="editdiv"><input type="text" class="input"></textarea><input type = "submit"  name= "submitname" class="submit" ><i class="fa fa-check"></i></input></div></form>');
                            if (!$(this).find(".input").length) {
                                tdval = $(this).text();
                                $(this).html(editdiv);
                                $('.input', $(this)).val(tdval);
                                $('.input', $(this)).focus();
                                $(document).on('click', '.submit', function(event) {
                                    inputval = $('.input', $(this).closest(".editdiv")).val();
                                    $(this).closest(".editdiv").parent(td_name_edit).html(inputval);
                                    i++
                                    //$("#figform").submit();
                                    Updateinfo(figure_id, inputval, "figname");
								//setTimeout(function(){window.location='wheels_edit.php?set_id='+set_id+'&name='+ figname; }, 1500);

                                });
                            }
                    });
                }); 
                $(document).ready(function() {
                    $(td_a_text_edit).on("click", function() {
                        var tdval, inputval, editdiv = "";
                        editdiv = $('<form method="POST" id="abilityform"><div class="editdiv"><textarea rows="6" cols="60" class="input"></textarea><input type = "submit"  name= "submitname" class="submit" ><i class="fa fa-check"></i></input></div></form>');
                        if (!$(this).find(".input").length) {
                            tdval = $(this).text();
                            $(this).html(editdiv);
                            $('.input', $(this)).val(tdval);
                            $('.input', $(this)).focus();
                            $(document).on('click', '.submit', function(event) {
                                inputval = $('.input', $(this).closest(".editdiv")).val();
                                $(this).closest(".editdiv").parent(td_a_text_edit).html(inputval);
                                i++
                                //$("#abilityform").submit();
                                Updateinfo(figure_id, inputval, "ability");
								//setTimeout(function(){window.location='wheels_edit.php?set_id='+set_id+'&name='+ figname; }, 500);
                            });
                        }
                    });
                });     
                   
            }
            /////name edit
            name_edit();
            function name_edit(){
                //span
                let name_edit = document.createElement('td');
                name_edit.classList.add('listen_pls');
                name_edit.classList.add('res_td');
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
                $(document).ready(function() {
                    $(name_edit).on("click", function() {
                        var tdval, inputval, editdiv = "";
                        editdiv = $('<form method="POST" id="nameform"><div class="editdiv"><input  type="text" class="input"><input type = "submit"  name= "submitname" class="submit" ><i class="fa fa-check"></i></input></div></form>');
                        if (!$(this).find(".input").length) {
                            tdval = $(this).text();
                            $(this).html(editdiv);
                            $('.input', $(this)).val(tdval);
                            $('.input', $(this)).focus();
                            $(document).on('click', '.submit', function(event) {
                                inputval = $('.input', $(this).closest(".editdiv")).val();
                                $(this).closest(".editdiv").parent(name_edit).html(inputval);
                                i++
                                //$("#nameform").submit();
                                Update(atk_id, inputval, type);
								setTimeout(function(){window.location='wheels_edit.php?set_id='+set_id+'&name='+ figname; }, 500);
                            });
                        }
                    });

                });  
                 
            }
            /////name edit
            /////size edit
            var sizecount;
            size_edit();
            function size_edit(){
                //span
                let size_edit = document.createElement('td');
                tr.appendChild(size_edit);
                size_edit.classList.add('res_td');
                //span in td
                let output_size = document.createElement('span');
                output_size.id = 'size';
                var type = output_size.id;
                output_size.id = 'size'+i;
                size_edit.appendChild(output_size);
                output_size.innerHTML = size;
                if (size != "0") {
                    sizes.push(size);
                }
                ///jquery name
                $(document).ready(function() {
                $(size_edit).on("click", function() {
                        var tdval, inputval, editdiv = "";
                        editdiv = $('<form method="POST" id="sizeform"><div class="editdiv"><input type="int" class="input"><input type = "submit"  name= "submitsize" class="submit" ><i class="fa fa-check"></i></input></div></form>');
                        if (!$(this).find(".input").length) {
                            tdval = $(this).text();
                            $(this).html(editdiv);
                            $('.input', $(this)).val(tdval);
                            $('.input', $(this)).focus();
                            $(document).on('click', '.submit', function(event) {
                                inputval = $('.input', $(this).closest(".editdiv")).val();
                                $(this).closest(".editdiv").parent(size_edit).html(inputval);
                                i++
                                //$("#sizeform").submit();
                                
                                Update(atk_id, inputval, type);
								setTimeout(function(){window.location='wheels_edit.php?set_id='+set_id+'&name='+ figname; }, 500);
                            });
                        }
                    });
                });  
            }

            ////size edit
            /////damage edit
            damage_edit();
            function damage_edit(){
                //span
                let damage_edit = document.createElement('td');
                damage_edit.classList.add('res_td');
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
                $(document).ready(function() {
                $(damage_edit).on("click", function() {
                        var tdval, inputval, editdiv = "";
                        editdiv = $('<form method="POST" id="damageform"><div class="editdiv"><input type="int" class="input"><input type = "submit"  name= "submitsize" class="submit" ><i class="fa fa-check"></i></input></div></form>');
                        if (!$(this).find(".input").length) {
                            tdval = $(this).text();
                            $(this).html(editdiv);
                            $('.input', $(this)).val(tdval);
                            $('.input', $(this)).focus();
                            $(document).on('click', '.submit', function(event) {
                                inputval = $('.input', $(this).closest(".editdiv")).val();
                                $(this).closest(".editdiv").parent(damage_edit).html(inputval);
                                i++
                                //$("#damageform").submit();
                                Update(atk_id, inputval, type);
								setTimeout(function(){window.location='wheels_edit.php?set_id='+set_id+'&name='+ figname; }, 500);
                            });
                        }
                    });
                });  
            }
            ////damage edit
            ////descr edit
            descr_edit();
            function descr_edit(){
            let descr_edit = document.createElement('td');
            descr_edit.classList.add('res_td');
            tr.appendChild(descr_edit);
            let output_descr = document.createElement('span');
            output_descr.id = 'descr';
            var type = output_descr.id;
            output_descr.id = 'descr'+i;
            descr_edit.appendChild(output_descr);
            output_descr.innerHTML = descr;
            output_descr.style.width = "200px";
            $(document).ready(function() {
                $(descr_edit).on("click", function() {
                        var tdval, inputval, editdiv = "";
                        editdiv = $('<form method="POST" id="descrform"><div class="editdiv"><input type="text" class="input"><input type = "submit"  name= "submitdescr" class="submit" ><i class="fa fa-check"></i></input></div></form>');
                        if (!$(this).find(".input").length) {
                            tdval = $(this).text();
                            $(this).html(editdiv);
                            $('.input', $(this)).val(tdval);
                            $('.input', $(this)).focus();
                            $(document).on('click', '.submit', function(event) {
                                inputval = $('.input', $(this).closest(".editdiv")).val();
                                $(this).closest(".editdiv").parent(descr_edit).html(inputval);
                                i++
                                //$("#descrform").submit();
                                Update(atk_id, inputval, type);
								setTimeout(function(){window.location='wheels_edit.php?set_id='+set_id+'&name='+ figname; }, 500);
                            });
                        }
                    });
                });
            }  
            /////color edit
            color_edit();
            function color_edit(){
                //span
                let color_edit = document.createElement('td');
                color_edit.classList.add('res_td');
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
                $(document).ready(function() {
                $(color_edit).on("click", function() {
                        var tdval, inputval, editdiv = "";
                        editdiv = $('<form method="POST" id="colorform"><div class="editdiv"><select name="colors" class="input" multiple><option value="white">White</option><option value="red">Red</option><option value="gold">Gold</option><option value="purple">Purple</option><option value="blue">Blue</option></select><input type = "submit"  name= "submitsize" class="submit" ><i class="fa fa-check"></i></input></div></form>');
                        if (!$(this).find(".input").length) {
                            tdval = $(this).text();
                            $(this).html(editdiv);
                            $('.input', $(this)).val(tdval);
                            $('.input', $(this)).focus();
                            $(document).on('click', '.submit', function(event) {
                                inputval = $('.input', $(this).closest(".editdiv")).val();
                                $(this).closest(".editdiv").parent(color_edit).html(inputval);
                                i++
                                //$("#colorform").submit();
                                Update(atk_id, inputval, type);
								setTimeout(function(){window.location='wheels_edit.php?set_id='+set_id+'&name='+ figname; }, 500);
								
                            });
                        }
                    });
                });  
            }
            
                let insert_new = document.createElement('td');
                insert_new.classList.add('res_td');
                tr.appendChild(insert_new);
                //span in td
                let insert_new_span = document.createElement('span');
                insert_new.id = 'insert'+i;
                insert_new.appendChild(insert_new_span);
                insert_new_span.innerHTML = "<i class='fa fa-plus-circle' aria-hidden='true'></i>";
                $(document).ready(function() {
                $("#insert"+i).on("click", function() {
                    Create_row(atk_id, set_id);
					setTimeout(function(){window.location='wheels_edit.php?set_id='+set_id+'&name='+ figname; }, 500);
                   
					
                    });
                }); 
                let delete_this = document.createElement('td');
                delete_this.classList.add('res_td');

                tr.appendChild(delete_this);
                //span in td
                let delete_span = document.createElement('span');
                delete_this.id = 'delete'+i;
                delete_this.appendChild(delete_span);
                delete_span.innerHTML = "<i class='fa fa-trash' aria-hidden='true'></i>";
                $(document).ready(function() {
                $("#delete"+i).on("click", function() {
                    Delete(atk_id);
					setTimeout(function(){ window.location='wheels_edit.php?set_id='+set_id+'&name='+ figname; }, 500); 
                    
                    });
                }); 
            ////damage edit
            
                $(function() {
                    $("tr").hover(function() {
                    //alert("hi");
                    $(this).addClass('is-dimmed');
                    });

                    $("td").mouseout(function() {
                        console.log('d');
                        });
                });
                $(function() {
                    $(".selected").hover(function() {
                    //alert("hi");
                    $(this).addClass('is-dimmed2');
                    });

                    $("td").mouseout(function() {
                        console.log('d');
                        });
                });
            
            
                

            ///edit jquery



          ///////

               

          document.getElementById("table"+set_id).prepend(tr_top);

          document.getElementById("table"+set_id).appendChild(tr);
 
		var intro2 = document.createElement('div');

                var intro2_text = document.createElement('h1');
                    intro2.appendChild(intro2_text);

                    let fig2_info = document.createElement('h2');
                    intro2.appendChild(fig2_info);  
                    fig2_info.innerHTML += "Attack Info";

         var table2 = document.getElementById("table"+set_id);

        }
        table2.prepend(intro2); 
		
        ////sizes
        var sizes_insert = [];
        for(var i = 0; i< sizes.length; i++){
			if(sizes[i] > 0){
            sizes_insert.push(sizes[i]);
					}
					
        }

        /////colors
        var colors_insert = [];
        for(var i = 0; i< colors.length; i++){
			if(sizes[i] > 0){
            colors_insert.push(colors[i]);
			}
        }
        ///names
        var names_insert = [];
        for(var i = 0; i< names.length; i++){
			if(sizes[i] > 0){
            names_insert.push(names[i]);
			}
        }
        //damage
        var damages_insert = [];
        for(var i = 0; i< damages.length; i++){
			if(sizes[i] > 0){
            damages_insert.push(damages[i]);
			}
        }
console.log(sizes_insert);
	console.log(names_insert);
	console.log(damages_insert);
	console.log(colors_insert);
    /////make chart
        var data = {
    datasets: [{
        data: sizes_insert,
        borderAlign: "inner",
        borderColor: "#333",
        backgroundColor: colors_insert,
        label: names_insert, // for legend
    label2: damages_insert,
	label3: colors_insert// for legend
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
    let button_view = document.createElement("button");
    button_view.innerHTML ="View this figure";
    document.body.appendChild(button_view);


    $(button_view).on("click", function() {
            document.location.href = 'wheels.php?set_id=<?php echo $set_id ?>&name=<?php echo $figname ?>';

    });
});
$(document).ready(function() {
    let button_delete_figure = document.createElement("button");
    button_delete_figure.innerHTML ="Delete this figure";
    button_delete_figure.style.marginLeft = "10px";
    document.body.appendChild(button_delete_figure);


    $(button_delete_figure).on("click", function() {
        if(confirm("Do you want to delete this figure?")){
            if(confirm("Are you sure that you want to delete this wonderful creation? This CAN NOT be undone!")){
                Delete_figure(fig_id);
setTimeout(function(){ window.location='index.php'; }, 500); 

            }
            else{
                return false;
            }
            // Delete_figure(fig_id);
        }
        else{
            return false;
        }
        
    });
});


    }
        function download_image(){
            var canvas = document.getElementById("pieChart");
            image = canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");
            var link = document.createElement('a');
            link.download = "<?php echo $_GET['name']?>.png";
            link.href = image;
            link.click();
        }
        function clearCache(){
            var setcookie  = 'access' + <?php echo  $set_id?>;
            localStorage.removeItem(setcookie);
        }
		function home(){
		document.location.href = 'index.php';
}
</script>

</body>

</html>