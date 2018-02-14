<?php echo $this->Html->docType(); ?>
<html>
	<head>
		<?php
	        echo $this->Html->css([
	            '/vendor/bootstrap/css/bootstrap.min',
	            '/vendor/metisMenu/metisMenu.min',
	            'sb-admin-2.min',
	            '/vendor/font-awesome/css/font-awesome.min',
		        '/vendor/datatables-plugins/dataTables.bootstrap',
		        '/vendor/datatables-responsive/dataTables.responsive',
	        ]); 
		?>
	</head>

	<body>

	    <div id="wrapper">
	        <!-- Navigation -->
			<?= $this->element('navbar'); ?>


	    	<div id="page-wrapper">
	    		<?= $this->Flash->render() ?>
				<?= $this->fetch('content'); ?>
			</div>


	    </div>
	    <!-- /#wrapper -->




		<?php 
			echo $this->Html->script([
				// 'jquery-3.1.1.min',
				'/vendor/jquery/jquery.min',
				'/vendor/bootstrap/js/bootstrap.min',
				'/vendor/metisMenu/metisMenu.min',
				'sb-admin-2.min',
		        '/vendor/datatables/js/jquery.dataTables.min',
		        '/vendor/datatables-plugins/dataTables.bootstrap.min',
		        '/vendor/datatables-responsive/dataTables.responsive'
			]); 
		?>

		<?php echo $this->fetch('script'); ?>
	</body>
</html>


