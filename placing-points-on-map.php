function view_main_map($region){

	if ($region) {
		$map_data = get_region_table($region);
	
		?>	
		<div id="map" style="width: 100%; height: 400px"></div>
		<script>
		ymaps.ready(init);

		function init () {

			var myMap = new ymaps.Map("map", {
					center: [61.698653, 99.505405],
					zoom: 2,
					controls: ['smallMapDefaultSet']
				}),
				myCollection = new ymaps.GeoObjectCollection(null, {
					preset: 'islands#blueIcon'
				})

			myCollection
			<?php foreach ($map_data as $map_object) : ?>
				.add(new ymaps.Placemark([<?php echo $map_object['coords']; ?>], {
					balloonContentHeader: '<?php echo $map_object['name']; ?>',
					balloonContentBody: '<?php echo $map_object['adres']; ?>',
					balloonContentFooter: "Подвал",
				   
					hintContent: '<?php echo $map_object['name']; ?>',
					
				}, {
					balloonPanelMapMaxArea:Infinity,//не работает
					balloonMaxWidth:300,
					preset: 'islands#icon',
					iconColor: '#0095b6'
				}))
			<?php endforeach; ?>		
				;
				
			myMap.geoObjects.add(myCollection);
			 
			// Выставляем масштаб карты чтобы были видны все группы.
			myMap.setBounds(myMap.geoObjects.getBounds(), {checkZoomRange:true}).then(function(){ 
			if(myMap.getZoom() > 15) myMap.setZoom(15); // Если значение zoom превышает 15, то устанавливаем 15.
			});

		}

		</script>
		<?php 	
	}
}
