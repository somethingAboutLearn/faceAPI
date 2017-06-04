"use strict";
$(function(){
	$("#jl-true").hide();
	//点击事件
	$('.jl-punch-card').click(function(){
		$(this).animate({
			opacity:0,
		},400).hide();
		$('.jl-lt').addClass('jl-lt-move');
		$('.jl-rt').addClass('jl-rt-move');
		$('.jl-lb').addClass('jl-lb-move');
		$('.jl-rb').addClass('jl-rb-move');
		//摄像头
		$('#jl-webcam').show(800);
		Webcam.set({
				// live preview size
				width: 320,
				height: 240,
				// device capture size
				dest_width: 640,
				dest_height: 480,
				// final cropped size
				crop_width: 480,
				crop_height: 480,
				// format and quality
				image_format: 'jpeg',
				jpeg_quality: 90,
				// flip horizontal (mirror mode)
				flip_horiz: true
			});
			Webcam.attach('#jl-camera');
			// preload shutter audio clip
			$('#jl-post-take-button').hide();
		let shutter = new Audio();
		shutter.autoplay = false;
		function preview_snapshot() {
			// play sound effect
			try { shutter.currentTime = 0; } catch(e) {;} // fails in IE
			shutter.play();
			// freeze camera so user can preview current frame
			Webcam.freeze();
			// swap button sets
			$('#jl-pre-take-button').hide();
			$('#jl-post-take-button').show();
		}
		function cancel_preview() {
			// cancel preview freeze and return to live camera view
			Webcam.unfreeze();
			// swap buttons back to first set
			$('#jl-pre-take-button').show();
			$('#jl-post-take-button').hide();
		}
		function save_photo() {
			// actually snap photo (from preview freeze) and display it
			Webcam.snap( function(data_uri) {
				// display results in page
				$('#jl-result').html(
					'<img src="'+data_uri+'"/><br/></br>'
				);
				// shut down camera, stop capturing
				Webcam.reset();
				// show results, hide photo booth
			$('#jl-result').show();
			$('#jl-webcam').hide();
			$("#jl-true").show();
			let t=setTimeout(function(){
				let $src=$('#jl-result img').attr("src");
				$("#myphoto").val($src);
			},1);
			} );
		}
		//调用方法
		$('.jl-take').click(function(){
			preview_snapshot();
		});
		$('.jl-back').click(function(){
			cancel_preview();
		})
		$('.jl-save').click(function(){
			save_photo();
		})
	});
	//success
	$('.jl-menu li').eq(0).addClass('selected');
	$('.jl-menu li').each(function(index){
		$(this).click(function(){
			$('.jl-menu li').removeClass('selected').eq(index).addClass('selected');
			$('.jl-tab').hide().eq(index).show(200);
		});
	});
	
	
			
})
