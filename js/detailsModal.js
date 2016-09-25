function detailsmodal(id){
  var data = {"id": id};
  $.ajax({
    url: '/EcommerceProject/includes/detailsModal.php',
    method : "post",
    data : data,
    success: function(data){
      $('body').append(data);
      $('#details-modal-' + id).modal('toggle');

    },
    error: function(){
      alert("Erreur connexion ajax:");
    }
  });
}
