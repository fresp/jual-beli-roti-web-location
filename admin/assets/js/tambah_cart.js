$('#add-cart').click(function(){

	var id = $('#kode-produk').val();
	var qtyProduk = $('#qty-p').val();

	$.ajax({
		type:'POST',
		url :base_url+'browse/insert_cart',
		dataType:'text',
		data:{'id':id,
			  'qty':qtyProduk},
		cache:false,
		success: function()
		{
			$('.brs-count-cart').load(base_url+'browse/count_cart');
		}
	});

});