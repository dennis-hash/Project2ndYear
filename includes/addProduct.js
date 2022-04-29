var county = document.getElementById('county').value;
var subCounty = document.getElementById('subcounty').value;

/*main.addEventListener('change', function(){
    var county = document.getElementById('county').value;
    var subCounty = document.getElementById('subcounty').value;
    console.log(county);
    console.log("subcounty");
    if(county == ""){
        document.getElementById('subcounty').innerHTML = "<option value=''>Select Sub-County</option>";
    }else{
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('subcounty').innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "includes/addProduct.php?county="+county, true);
        xmlhttp.send();
    }
});*/
 function populate(){
    var county = document.getElementById('county').value;
    var subCounty = document.getElementById('subcounty').value;
    console.log(county);
    
    // get the county id
    var county_id = this.value;

    
    if(county == "Mombasa"){
        var subCounty = ['Likoni',
            'Mombasa',
            'Nyali',
            'Kisauni',
            'Changamwe',
            'Jomvu'];
       
    }else if(county = "Kwale"){
        var subCounty = ['Matuga', 
            'Kinango', 
            'LungaLunga', 
            'Msambweni' ];
    }else if(county = "Kilifi"){
        var subCounty = ['Ganze ',
            'Rabai ',
            'Malindi ',
            'Kaloleni ',
            'Magarini ',
            'Kilifi north ',
            'Kilifi south '];

    }else if(county = "Tana River"){
        var subCounty = ['Tana River',
            'Tana delta',
            'Tana North'];

    }else if(county = "Lamu"){
        var subCounty = ['Lamu East',
            'Lamu West',
           ];

    }else if(county = "Taita Taveta"){
        var subCounty = [
            'Voi',
            'Taita',
            'Taveta',
            'Mwatate',];


    }else if(county = "Garissa"){
        var su
    }else if(county = "Wajir"){

    }
    else if(county = "Mandera"){

    

    }else if(county = "Marsabit"){

    

    }else if(county = "Isiolo"){

    

    

    }else if(county = "Meru"){

    

    

    

    }else if(county = "Tharaka Nithi"){


    }else if(county = "Embu"){


    }else if(county = "Kitui"){

    }else if(county = "Machakos"){

    }else if(county = "Makueni"){

    }else if(county = "Nyandarua"){


    }else if(county = "Nyeri"){

    }else if(county = "Kirinyaga"){


    }else if(county = "Murang'a"){

    }else if(county = "Kiambu"){


    }else if(county = "Turkana"){

    }else if(county = "West Pokot"){

    }else if(county = "Samburu"){


    }else if(county = "Trans-Nzoia"){

    }else if(county = "Uasin Gishu"){

    }else if(county = "Elgeyo Marakwet"){

    }else if(county = "Nandi"){

    }else if(county = "Baringo"){

    }else if(county = "Laikipia"){

    }else if(county = "Nakuru"){


    }else if(county = "Narok"){


    }else if(county = "Kajiado"){

    

    }else if(county = "Kericho"){


    }else if(county = "Bomet"){

    

    }else if(county = "Kakamega"){

    

    }else if(county = "Vihiga"){

    


    }else if(county = "Bungoma"){
    

    }else if(county = "Kisumu"){


    }else if(county = "Homa Bay"){

    }else if(county = "Migori"){


    }else if(county = "Kisii"){

    }else if(county = "Nyamira"){

    }else if(county = "Nairobi"){

    }

    else {

    }
    for(var option in subCounty){
        var subCountyOption = document.createElement('option');
        subCountyOption.value = subCounty[option];
        subCountyOption.innerHTML = subCounty[option];
        document.getElementById('subcounty').appendChild(subCountyOption);
    }


}