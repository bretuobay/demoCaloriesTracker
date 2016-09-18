/**
 * Created by bretuobay on 18/09/2016.
 */

   function logOutUser(){

       $.ajax({
           type: 'POST',
           url: "index.php?section=users&do=logout",
           error: function(data){
               console.log(data)
           },
           data: {},
           success: function(data) {
               window.location.replace('front_app.php');
           },
           dataType: "json"
       });

   }

function saveCaloriesEntry(){

    var data = {
        "id" : $("#id").val(),
        "description" : $("#description").val(),
        "num_calories" : $("#num_calories").val(),
        "date" : $("#date").val(),
        "time" : $("#time").val()
    };

    var url = (data.id==='')? "index.php?section=calories&do=save" : "index.php?section=calories&do=edit";

    if(data.description==='' || data.num_calories===''){
        alert('Description and number of calories cannot be null');
        return;
    }

    $.ajax({
        type: 'POST',
        url: url,
        error: function(data){
            console.log(data)
        },
        data: data,
        success: function(data) {
            if(data.success){
                alert('Entry saved with success!');
            }

        },
        dataType: "json"
    });


}


function populaSelectField(data){
    $('select#calorieslist option').each(function() {
        $(this).remove();
    });

    $.each(data, function(i, item) {
        $('select#calorieslist').
            append($("<option></option>").
                attr("value", item.id).
                text(item.description));
    });
}

function getCalories() {

    $.when($.ajax({
        type: 'GET',
        url: 'index.php?section=calories&do=index',
        success: function(data) {
            //console.log(data);
        },
        dataType: 'json'

    })).then(function(data, textStatus, jqXHR) {

            //console.log(data);
        populaSelectField(data.data);


    });
    //
}


function getCaloriesEntry() {

    $.when($.ajax({
        type: 'POST',
        data : {id: $('select#calorieslist').val()},
        url: 'index.php?section=calories&do=find',
        success: function(data) {

        },
        dataType: 'json'

    })).then(function(data, textStatus, jqXHR) {

                $("#id").val(data.data.id);
                 $("#description").val(data.data.description);
                 $("#num_calories").val(data.data.num_calories);
                 $("#date").val(data.data.date);
                 $("#time").val(data.data.time);

    });

}

function deleteCaloriesEntry(){

    $.when($.ajax({
        type: 'POST',
        data : {id: $('select#calorieslist').val()},
        url: 'index.php?section=calories&do=delete',
        success: function(data) {

        },
        dataType: 'json'

    })).then(function(data, textStatus, jqXHR) {

       alert("Selected Entry successfully deleted");

    });

}

function getCaloriesConsumed(){

     var data = {
         "end" : $("#end").val(),
         "begin" : $("#begin").val()
     };
     if(data.end==='' || data.begin===''){
         alert('Must fill all fields');
         return;
     }

    $.ajax({
        type: 'POST',
        url: "index.php?section=calories&do=filter",
        error: function(data){
            console.log(data)
        },
        data: data,
        success: function(data) {
            if(data.total>0)
             $("#total_calories").text(data.total+' calories consumed in period');
            else
                $("#total_calories").text('No calories consumed in period');
        },
        dataType: "json"
    });


}


$( document ).ready(function() {

    getCalories();

    $("#dashboard").show();

    $("#dashboard-page").click(function(){
        $("#manage").hide();
        $("#setting").hide();
        $("#dashboard").show();

    });

    $("#management-page").click(function(){
        $("#manage").show();
        $("#setting").hide();
        $("#dashboard").hide();

    });

    $("#setting-page").click(function(){
        $("#manage").hide();
        $("#setting").show();
        $("#dashboard").hide();

    });


    $("#logout_link").click(function(){
        logOutUser();
    });


    $("#calories-button").click(function(){

        saveCaloriesEntry();
        //event.preventDefault();

    });

    $("#fill-form").click(function(){
        getCaloriesEntry();

    });

    $("#delete-entry").click(function(){
        deleteCaloriesEntry();

    });

    $("#filter-button").click(function(){
        getCaloriesConsumed();

    });


});




