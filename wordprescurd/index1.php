<?php /* Template Name: index1 */ 
get_header();


?>


<body>
<div class="wrap">
  <div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

  <div>
      <table border="1">
        <thead>
        <tr style="background: black; color: white">
          <td>First Name</td>
          <td>Last Name</td>
          <td>Gender</td>
          <td>Hobbies</td>
          <td>States</td>
          <td>Delete</td>
          <td>Edit</td>
        </tr>
        </thead>
        <tbody></tbody>

        <?php

          global $wpdb;
          $myrows = $wpdb->get_results( "SELECT * FROM wp_demo" );
          foreach($myrows as $a)
          {
            ?>
              <tr class="id<?php echo $a->id;?>">
              <td><?php echo $a->fname ?></td>
              <td><?php echo $a->lname ?></td>
              <td><?php echo $a->gender ?></td>
              <td><?php echo $a->hobbies ?></td>
              <td><?php echo $a->states ?></td>
              <td><a href="#" class="delete" id="del_<?php echo $a->id; ?>">Delete</a></td>
              <td><a href="#" class="edit" id="edi_<?php echo $a->id; ?>">Edit</a></td>
              </tr>

          <?php  
          }
        ?>


      </table>


  </div>
<form id="form" name="form" method="post">
  First Name<input type="text" name="fname" id="fname" value="">
  Last Name<input type="text" name="lname" id="lname" value="">
  gender<input type="text" name="gender" id="gender" value="">
  hobbies<input type="text" name="hobbies" id="hobbies" value="">
  sate<input type="text" name="states" id="states" value="">
  <input type="hidden" name="id" id="id" value="">
  <input type="submit" name="submit" id="submit">
</form>


    </main><!-- #main -->
  </div><!-- #primary -->
</div><!-- .wrap -->

</body>


<script type="text/javascript">
  var ajaxurl = "<?php echo admin_url('admin-ajax.php');?>";

  jQuery(function(){
    jQuery('#form').submit(function(event){
      event.preventDefault();
      var userdata = jQuery('#form').serialize();
      userdata= userdata + "&action=test_ajax";
      //alert(userdata);
      jQuery.ajax({

            dataType:"json",
            type:"post",

            //data : jQuery('#form').serialize(),
             data:userdata,
            url:ajaxurl,
             success: function(data) 
             {
               alert('done');
               location.href = "http://localhost/salman/index1/"
               jQuery("#form")[0].reset();
             }


      });



  });
  });
</script>


<script type="text/javascript">
  var ajaxurl = "<?php echo admin_url('admin-ajax.php');?>";
  jQuery(function(){
        jQuery('.delete').click(function(){
          
          var el = this;
          var id = this.id;
          var splitid = id.split("_");
           
           var deleteid = splitid[1];
           var deleteid2 = splitid[1];
            
            deleteid="id="+ deleteid+ "&action=test_ajax2";

            jQuery.ajax({

            dataType:"json",
            type:"post",

            //data : jQuery('#form').serialize(),
             data:deleteid,
            url:ajaxurl,
             success: function(data) 
             {
               alert('Delete');
                
               jQuery('.id'+deleteid2).remove();
               
             }
          });
             })
    });
</script>


<script type="text/javascript">
  var ajaxurl = "<?php echo admin_url('admin-ajax.php');?>";
  jQuery(function(){
        jQuery('.edit').click(function(){
          var el = this;
          var id = this.id;
          var splitid = id.split("_");
           
           var editid = splitid[1];
            
            editid="id="+ editid+ "&action=test_ajax3";

            jQuery.ajax({

            dataType:"json",
            type:"post",

            //data : jQuery('#form').serialize(),
             data:editid,
            url:ajaxurl,
             success: function(data) 
             {


               console.log(data.data[0]);
             jQuery('#id').val(data.data[0].id);
              jQuery('#fname').val(data.data[0].fname);
              jQuery('#lname').val(data.data[0].lname);
              jQuery('#gender').val(data.data[0].gender);
              jQuery('#hobbies').val(data.data[0].hobbies);
              jQuery('#states').val(data.data[0].states);

               // alert('done');
               
             }
          });
             })
    });
</script>

<!-- <script type="text/javascript">
  var ajaxurl = "<?php echo admin_url('admin-ajax.php');?>";
  jQuery(function(){

    jQuery.ajax({

            dataType:"json",
            type:"post",

            //data : jQuery('#form').serialize(),
             data:{'action':'view'},
            url:ajaxurl,
             success: function(data) 
             {

                $('tbody').html(data)
             }
  });
    });

</script>
 -->

<?php get_footer();