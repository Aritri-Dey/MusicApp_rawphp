/**
 * Function to show/hide login/registration form in a popup on button click.
 */
$(document).ready(function() {
  $('#loginBtn').click(function() {
    $(".loginPopup").css("display","flex");
    $(".top").css("pointer-events","none");
  });

  $('#closeLogin').click(function() {
    $(".loginPopup").css("display","none");
    $(".top").css("pointer-events","all");
  });

  $('#regBtn').click(function() {
    $(".registerPopup").css("display","flex");
    $(".top").css("pointer-events","none");
  });

  $('#closeReg').click(function() {
    $(".registerPopup").css("display","none");
    $(".top").css("pointer-events","all");
  });
});

/**
 * Function to get values from registration form and check if fields are empty 
 * or not. If not empty, data is sent through ajax and inserted into database.
 */
$(document).ready(function() {
  $('#submitReg').click(function() {
    var name = $("#userNameReg").val();
    var email = $("#emailReg").val();
    var number = $("#numberReg").val();
    var genre = document.getElementsByName("genre[]");
    var password = $("#passwordReg").val();
    if (name == "" || email == "" || number == "" || password == "" ) {
      $('#response').html('All fields are required');
    }
    else {
      $.ajax({ 
        url : "insertData.php",
        type : "POST",
        data: $("#registerForm").serialize(),
        success : function(data) {
          $("#response").html(data);
        }
      });
    }
  });
});

/**
 * Function to get values from update form and check if fields are empty 
 * or not. If not empty, data is sent through ajax and updated in the database.
 */
$(document).ready(function() {
  $('#updateBtn').click(function() {
    var oldEmail = $("#oldEmail").val();
    var newEmail = $("#newEmail").val();
    var number = $("#phone").val();
    var genre = document.getElementsByName("genreUpdate[]");
    if (oldEmail == "" || newEmail == "" || number == "") {
      $('#msg').html('All fields are required');
    }
    else {
      $.ajax({ 
        url : "updateData.php",
        type : "POST",
        data: $("#updateForm").serialize(),
        success : function(data) {
          $("#msg").html(data);
        }
      });
    }
  });
});
//|| !$('input:checkbox[name=genre]').is(':checked')

/**
 * Function to implement pagination in the music library page.
 */
$(document).ready(function(){
  function loadData(page) {
    $.ajax({
      url: "ajax-pagination.php",
      type: "POST",
      data: {
        pageNo: page
      },
      success: function(data) {
        if (data) {
          $(".loadMoreBtn").remove();
          $(".row").append(data);
        }
        else {
          $(".loadMoreBtn").html("No more data");
          $(".loadMoreBtn").prop("disabled", TRUE);
        }
      }
        
    });
  }
  loadData();
  $(document).on("click", ".loadMoreBtn", function() {
    $(".loadMoreBtn").html("Loading...");
    var pid = $(this).data("id");
    loadData(pid);
  });
});

/**
 * Function to add a song to favourites.
 */
function addFav(id) {
  $.ajax({
    url: "addFav.php",
    type: "POST",
    data: {
      id: id
    },
    success: function(response) {
      //adding a class to icon to chnge color on successfully adding song to fav table
      console.log(response);
      if (response == "added") {
        $("#" + id).children("i").css("color","red");
      }
      else {
        $("#" + id).children("i").css("color","white");
      }
    },
  });
}
