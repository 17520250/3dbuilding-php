 <script src="https://js.arcgis.com/4.16/"></script>

 <script>
   require([
     "esri/Map",
     "esri/views/SceneView",
     "esri/layers/GeoJSONLayer",
     "esri/layers/SceneLayer",
     "esri/Graphic",
     "esri/symbols/PathSymbol3DLayer",
   ], function(
     Map,
     SceneView,
     GeoJSONLayer,
     SceneLayer,
     Graphic,
     PathSymbol3DLayer
   ) {
     <?php

      if ($ma_tang != 'tatca') {
        $db->where('a.MaTang', $ma_tang);
      }
      if ($ma_kien_truc != 'tatca') {
        $db->where('MaKienTruc', $ma_kien_truc);
      }
      if ($trang_thai_bt != 'tatca') {
        $db->where('TrangThaiBT', $trang_thai_bt);
      }
      if ($ma_loai_kien_truc != 'tatca') {
        $db->where('a.MaLoaiKienTruc', $ma_loai_kien_truc);
      }
      if ($ma_vat_lieu != 'tatca') {
        $db->where('a.MaVatLieu', $ma_vat_lieu);
      }

      $db->join('loaikientruc b', 'a.MaLoaiKienTruc=b.MaLoaiKienTruc', 'LEFT');
      $db->join('vatlieu c', 'a.MaVatLieu=c.MaVatLieu', 'LEFT');
      $db->join('tang d', 'a.MaTang=d.MaTang', 'LEFT');
      $get_kientruc = $db->ObjectBuilder()->get('kientruc a');
      foreach ($get_kientruc as $row) {
      ?>

       const geojsonLayer<?= $row->MaKienTruc ?> = new GeoJSONLayer({
         url: "assets/upload/geojson/<?= $row->GeojsonKienTruc ?>",
         popupTemplate: {
           title: "<b><?= $row->TenKienTruc ?></b>",
           content: "Loại kiến trúc: <?= $row->TenLoaiKienTruc ?><br>Vật liệu: <?= $row->TenVatLieu ?><br>Tầng: <?= $row->TenTang ?><br>Ngày hoàn thành: <?= $row->NgayHoanThanh ?><br>Hạn sử dụng vật liệu: <?= $row->HanSuDungVL ?> tháng<br>Hạn bảo trì: <?= $row->HanBaoTri ?><br>Trạng thái bảo trì: <?php if ($row->TrangThaiBT === '#00ff00') {
                                                                                                                                                                                                                                                                                                            echo 'Còn xa hạn bảo trì';
                                                                                                                                                                                                                                                                                                          } else {
                                                                                                                                                                                                                                                                                                            echo 'Sắp đến hạn bảo trì';
                                                                                                                                                                                                                                                                                                          } ?>"

         },
       });

       <?php
        if ($row->Symbol === 'polygon-3d') {
        ?>

         geojsonLayer<?= $row->MaKienTruc ?>.renderer = {
           type: "simple",
           symbol: {
             type: "polygon-3d",
             symbolLayers: [{
               type: "extrude",
               size: <?= $row->Size ?>, //meters
               material: {
                 color: "<?= $row->Color ?>",
               },
             }, ],
           },
         };

       <?php
        } else if ($row->Symbol === 'line-3d') {
        ?>

         geojsonLayer<?= $row->MaKienTruc ?>.renderer = {
           type: "simple",
           symbol: {
             type: "line-3d",
             symbolLayers: [{
               type: "path", // autocasts as new PathSymbol3DLayer()
               profile: "quad", // creates a rectangular shape
               width: <?= $row->Width ?>, // path width in meters
               height: <?= $row->Height ?>, // path height in meters
               material: {
                 color: "<?= $row->Color ?>",
               },
               cap: "square",
               profileRotation: "heading",
             }, ],
           },
         };

       <?php } ?>

     <?php } ?>

     const map = new Map({
       basemap: "topo-vector",
       ground: "world-elevation",
       layers: [
         <?php
          if ($ma_tang != 'tatca') {
            $db->where('MaTang', $ma_tang);
          }
          if ($ma_kien_truc != 'tatca') {
            $db->where('MaKienTruc', $ma_kien_truc);
          }
          if ($trang_thai_bt != 'tatca') {
            $db->where('TrangThaiBT', $trang_thai_bt);
          }
          if ($ma_loai_kien_truc != 'tatca') {
            $db->where('MaLoaiKienTruc', $ma_loai_kien_truc);
          }
          if ($ma_vat_lieu != 'tatca') {
            $db->where('MaVatLieu', $ma_vat_lieu);
          }
          $get_kientruc = $db->ObjectBuilder()->get('kientruc a');
          foreach ($get_kientruc as $row) {
          ?>
           geojsonLayer<?= $row->MaKienTruc ?>,
         <?php } ?>
       ],
     });

     const view = new SceneView({
       container: "mapid",
       map: map,
       camera: {
         position: [106.80379156027, 10.86685591091028, 230.7279187720269],
         heading: 0,
         tilt: 75,
       },
     });

     //view.popup.defaultPopupTemplateEnabled = true;
   });
 </script>