$(document).ready(function(){

  $("#bode").hide();
  $("#esconde").show();
  
  $('#mostra1').click(function(){
  $("#bode1").slideToggle();
  });
  
  $('#mostra2').click(function(){
    $("#bode2").slideToggle();
    });

  $('#mostra3').click(function(){
  $("#bode3").slideToggle();
  });

});

    function enviar() {
        var linha = $("#lista").val();
        var linhaenviar = linha.split("\n");
        var total = linhaenviar.length;
        var ap = 0;
        var ed = 0;
        var rp = 0;
        linhaenviar.forEach(function(value, index) {
            setTimeout(
                function() {
                  var e = document.getElementById("gate");
                var sk_live = $("#sk").val();
              var gate = e.options[e.selectedIndex].value;
                    $.ajax({
                        url: gate + '?lista=' + value + '&sk=' + sk_live,
                        type: 'GET',
                        async: true,
                        success: function(resultado) {
                            if (resultado.match("#CVV")) {
                                removelinha();
                                ap++;
                                aprovadas(resultado + "");
                            }else if(resultado.match("#CCN")) {
                                removelinha();
                                ed++;
                                edrovadas(resultado + "");
                           }else {
                                removelinha();
                                rp++;
                                reprovadas(resultado + "");
                            }
                            $('#carregadas').html(total);
                            var fila = parseInt(ap) + parseInt(ed) + parseInt(rp);
                            $('#cLive').html(ap);
                            $('#cWarn').html(ed);
                            $('#cDie').html(rp);
                            $('#total').html(fila);
                            $('#cLive2').html(ap);
                            $('#cWarn2').html(ed);
                            $('#cDie2').html(rp);
                        }
                    });
                }, 450 * index);
        });
    }
      function aprovadas(str) {
          $(".aprovadas").append(str + "<br>");
      }
      function reprovadas(str) {
          $(".reprovadas").append(str + "<br>");
      }
      function edrovadas(str) {
          $(".edrovadas").append(str + "<br>");
      }
      function removelinha() {
          var lines = $("#lista").val().split('\n');
          lines.splice(0, 1);
          $("#lista").val(lines.join("\n"));
      }