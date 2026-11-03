/**
 * Theme Options Admin JavaScript
 *
 * Implements:
 * 1. Hero Slider Repeater (+/- buttons)
 * 2. WordPress Media Uploader integration
 * 3. Dynamic row index calculation
 *
 * @package WPBrigade_Challenge
 */
(function ($) {
	'use strict';

	$(document).ready(function () {
		initHeroSliderRepeater();
	});

	function initHeroSliderRepeater() {
		var $repeater = $('#wpbc-slides-repeater');
		if (!$repeater.length) {
			return;
		}

		var $list = $('#wpbc-slides-list');
		var $addBtn = $('#wpbc-add-slide-btn');
		var templateHtml = $('#wpbc-slide-template').html();

		function reindexSlides() {
			$list.find('.wpbc-repeater-item').each(function (idx) {
				var slideNum = idx + 1;
				var $item = $(this);
				$item.attr('data-index', idx);
				$item.find('.slide-label').text('Slide #' + slideNum);

				$item.find('.wpbc-slide-img-url').attr('name', 'wpbc_options[hero_slides][' + idx + '][image]');
				$item.find('.wpbc-slide-title-input').attr('name', 'wpbc_options[hero_slides][' + idx + '][title]');
				$item.find('.wpbc-slide-content-input').attr('name', 'wpbc_options[hero_slides][' + idx + '][content]');
				$item.find('.wpbc-slide-video-input').attr('name', 'wpbc_options[hero_slides][' + idx + '][video_url]');
			});
		}

		$addBtn.on('click', function (e) {
			e.preventDefault();
			var newIndex = $list.find('.wpbc-repeater-item').length;
			var newSlideNum = newIndex + 1;

			var newRow = templateHtml
				.replace(/{{INDEX}}/g, newIndex)
				.replace(/{{SLIDE_NUM}}/g, newSlideNum);

			var $newRow = $(newRow);
			$list.append($newRow);
			reindexSlides();

			$newRow.find('.wpbc-slide-title-input').focus();
		});

		$list.on('click', '.wpbc-remove-slide-btn', function (e) {
			e.preventDefault();
			if (window.confirm('Are you sure you want to remove this slide?')) {
				var $item = $(this).closest('.wpbc-repeater-item');
				$item.fadeOut(200, function () {
					$item.remove();
					reindexSlides();
				});
			}
		});

		var mediaFrame;
		$list.on('click', '.wpbc-select-media-btn', function (e) {
			e.preventDefault();
			var $btn = $(this);
			var $box = $btn.closest('.wpbc-media-uploader-box');
			var $preview = $box.find('.wpbc-slide-img-preview');
			var $input = $box.find('.wpbc-slide-img-url');
			var $clearBtn = $box.find('.wpbc-remove-media-btn');

			if (mediaFrame) {
				mediaFrame.off('select');
			}

			mediaFrame = wp.media({
				title: 'Select or Upload Slide Image',
				button: {
					text: 'Use this Image'
				},
				multiple: false,
				library: {
					type: 'image'
				}
			});

			mediaFrame.on('select', function () {
				var attachment = mediaFrame.state().get('selection').first().toJSON();
				if (attachment && attachment.url) {
					$input.val(attachment.url);
					$preview.attr('src', attachment.url).show();
					$clearBtn.show();
				}
			});

			mediaFrame.open();
		});

		$list.on('click', '.wpbc-remove-media-btn', function (e) {
			e.preventDefault();
			var $btn = $(this);
			var $box = $btn.closest('.wpbc-media-uploader-box');
			$box.find('.wpbc-slide-img-url').val('');
			$box.find('.wpbc-slide-img-preview').attr('src', '').hide();
			$btn.hide();
		});
	}
})(jQuery);
