$(document).ready(function () {
    
   


    var discount = 0;
    var discount_val = 0;
    var nofseats = $('#form1').val();
    var seats_price = cprice * nofseats;
    $('.total_price').text('Rs. ' + (seats_price.toFixed(2)));
    $('#total').val(seats_price.toFixed(2));
    $('#seats').val(nofseats);
    $('#discount').val(discount);

    $('.seat_adjust').on('click', function () {
      var nofseats1 = $('#form1').val();
      seats_price = cprice * nofseats1;
      $('.total_price').text('Rs. ' + (seats_price.toFixed(2)));
      $('#total').val(seats_price.toFixed(2));
      $('#seats').val(nofseats1);
      $('#discount').val(discount);

      discount = ((seats_price / 100) * discount_val).toFixed(2);

              $('.total_price').text('Rs. ' + (seats_price - discount).toFixed(2));
              $('.discount').text('Rs. ' + discount);
              $('#total').val((seats_price - discount).toFixed(2));
              $('#discount').val(discount);

              

    });
    

    //promo add
    $('.add-promo').on('click', function () {
      if ($('#promo-code').val()) {
        if ($('#promo-code').val() == psngr_promo_code) {
          for (var index = 0; index < promolist.length; index++) {
            if($('#promo-code').val() == psngr_promo_code && psngr_promo_st=='1'){
              $('.promo-text').text('Promotion code used already!!');
            }
            if (promolist[index]['promo_id'] == psngr_promo_id && psngr_promo_st==0) {
              discount_val = promolist[index]['promo_value'];
              discount = ((seats_price / 100) * promolist[index]['promo_value']).toFixed(2);

              $('.total_price').text('Rs. ' + (seats_price - discount).toFixed(2));
              $('.discount').text('Rs. ' + discount);
              $('#total').val((seats_price - discount).toFixed(2));
              $('#discount').val(discount);
              $('.promo-text').text('');
              break;
            } else {
              $('.promo-text').text('Promotion code used already!!');
            }
          }
        } else {
              $('.promo-text').text('Invalid promotion code!!');
            }
      } else {
        $('.promo-text').text('Please add a promotion code');
      }

    });
  });