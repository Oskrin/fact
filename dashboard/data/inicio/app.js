// file map
// por dc
$(function(){
	mapa();
	llenar_mapa();
});
function mapa(){
	$('#map').html('');	
	// Icons
    var icons = [
        "img/map1.fw.png",
        "img/map2.fw.png"     
    ];
    var matriz=llenar_mapa()
    var sum=0;
    // Create random point features
    var i, lat, lon, geom, feature, features = [], style, rnd;
    for(i=0; i< matriz.length; i++) {
    	var mat=matriz[i];//posicion map lat , long
    	var pos=mat[2].split(",");
        lat = parseFloat(pos[0]);
        lon = parseFloat(pos[1]);
        var vec=[lat,lon];
        geom = new ol.geom.Point(ol.proj.transform(vec, 'EPSG:4326', 'EPSG:3857'));
        feature = new ol.Feature({
        	geometry: geom,
			name: 'My Polygon',
			id:mat[0],
			ty:mat[1]
        });
        features.push(feature);
        if (mat[1]=='lugar_turistico') sum=1;
        if (mat[1]=='establecimiento') sum=0;
        rnd = Math.random();
        style = [
            new ol.style.Style({
                image: new ol.style.Icon(({
                    anchor: [0.5, 1],
                    src: icons[sum]
                }))
            }),
            new ol.style.Style({
                image: new ol.style.Circle({
                    radius: 2,
                    fill: new ol.style.Fill({
                        color: 'rgba(20,120,30,0.7)'
                    })
                })
            })
        ];
        feature.setStyle(style);
    }    

    // Source and vector layer
    var vectorSource = new ol.source.Vector({
        features: features
    });

    var vectorLayer = new ol.layer.Vector({
        source: vectorSource
    });

    var map = new ol.Map({
      layers: [new ol.layer.Tile({ source: new ol.source.OSM() }), vectorLayer],
      target: document.getElementById('map'),
      view: new ol.View({
        center: ol.proj.transform([-78.26667,0.3], 'EPSG:4326', 'EPSG:3857'),
        zoom: 13
      })
    });
    // mouse event click
    map.on('click', function(evt) {
	  var feature = map.forEachFeatureAtPixel(evt.pixel,
	      function(feature, layer) {
	        return feature;
	      });
	  if (feature) {
	    var id=feature['C']['id'];
	    var ty=feature['C']['ty'];

	    mostrar_info(id,ty);
	  } else {
	    $('#modalinfo').modal('hide');
	  }
	});

	// mouse event pointer
	map.on('pointermove', function(e) {
		if (e.dragging) {
	    	$('#modalinfo').modal('hide');
	    	return;
	    }
	    var pixel = map.getEventPixel(e.originalEvent);
	    var hit = map.hasFeatureAtPixel(pixel);
	    map.getTarget().style.cursor = hit ? 'pointer' : '';
	});
}
function llenar_mapa(){
	var vec;
	$.ajax({
		url: 'app.php',
		type: 'post',
		data: {llenar_mapa:'ok'},
		dataType: 'json',
		async:false,
		success: function (data) {
			vec=data;
		}
	});
	return vec;
}
function mostrar_info(id,ty,posicion){
	$('#modalinfo').modal('show');

	$.ajax({
		url: 'app.php',
		type: 'post',
		data: {mostrar_info:'ok', id:id, ty:ty},
		dataType: 'json',
		async:false,
		success: function (data) {
			
      vec=data;
      Lockr.set('infodata', vec);
      Lockr.set('posicion', posicion);
      llenarmapa_2(posicion, ty, vec['nombre']);
      // descripcion
      if (ty=='lugar_turistico') {
        $('#element_1').html('<span>Clima: </span> <strong>'+vec['clima']+'</strong>');
        $('#element_2').html('<span>Tipo: </span> <strong>'+vec['tipo']+'</strong>');
        $('#element_3').html('<span>Teléfono: </span> <strong>'+vec['telefono']+'</strong>');
        $('#element_4').html('<span>Parroquia: </span> <strong>'+vec['parroquia']+'</strong>');
        $('#element_5').html('<span>Dirección: </span> <strong>'+vec['direccion']+'</strong>');
        $('#element_propietario').text(vec['propietario']);
        $('#element_descripcion').html(vec['descripcion']);
      }else{        
        $('#element_1').html('<span>Habitaciones: </span> <strong>'+vec['hab']+'</strong>');
        $('#element_2').html('<span>Parroquia: </span> <strong>'+vec['parroquia']+'</strong>');
        $('#element_3').html('<span>Tipo: </span> <strong>'+vec['tipo']+'</strong>');
        $('#element_4').html('<span>Teléfono: </span> <strong>'+vec['telefono']+'</strong>');
        $('#element_5').html('<span>Dirección: </span> <strong>'+vec['direccion']+'</strong>');
        $('#element_propietario').text(vec['propietario']);
        
        var acumestrella='';
        for (var i = 0; i < parseInt(vec['categoria']) ;i++) {
          acumestrella=acumestrella+'<span class="glyphicon glyphicon-star hellow font-18" aria-hidden="true"></span>';
        }        
      };

      $('#element_direccion').text(vec['direccion']);
      $('#element_nombre').text(vec['nombre']);
      $('#element_categoria').html(acumestrella);
      $('#element_website').attr('href', vec['sitio_web']);
      $('#element_website').html(vec['sitio_web']);
      $('#element_descripcion').html(vec['descripcion']);
      
      //fotografias
      img_vec=vec['fotos'];
      var acu='';
      var lugar = ty;
      if (ty=='lugar_turistico') {
        lugar='lugares_turisticos';
      };
      for (var i = 0; i < 3; i++) {
        var ulr_='<img src="../../dashboard/data/'+lugar+'/'+img_vec[i]+'" class="plan-box hyellow" width="100px" height="100px">';
        acu= acu+ulr_;
        
        if (i>8) {
          break;
        };
      }
      $('#element_img').html(acu);      
		}
	});
}

function triangular_mapa1(){
    $('#map1').html(''); 

}