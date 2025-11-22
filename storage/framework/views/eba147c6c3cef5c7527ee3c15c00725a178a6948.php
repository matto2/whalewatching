

<?php $__env->startSection('head'); ?>
<title><?php echo e(pageTitle('Directions')); ?></title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('stylesheets'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

					<h1>Directions</h1>

					<h2>Directions to Santa Cruz Whale Watching</h2>

					<p><img src="/images/map.jpg" alt="map"></p>

					<h3>OFFICE/CHECK-IN LOCATION</h3>
					<p><a href="https://www.google.com/maps/place/1718+Brommer+St,+Santa+Cruz,+CA+95062/@36.9710276,-121.984282,17z/data=!3m1!4b1!4m2!3m1!1s0x808e154efffd7055:0x4aa87629601b9988" target="_blank">1718 Brommer, Santa Cruz, CA 95062</a>  &larr; Click for Google Maps</p>

					<p>ALL PASSENGERS INCLUDING E-TICKET HOLDERS MUST SIGN IN AT OUR OFFICE 45 MINUTES PRIOR TO DEPARTURE TIME BEFORE PROCEEDING TO BOARDING LOCATION.</p>

					<p>Please allow yourself extra time for weekend and afternoon trips, as traffic is very heavy in this area, and we cannot wait for latecomers.</p>

					<h3>BOARDING LOCATION</h3>

					<p>ALL PASSENGERS MAY PROCEED TO BOARDING LOCATION AFTER FIRST CHECKING-IN AT OUR OFFICE 45 MINUTES PRIOR TO DEPARTURE TIME.</p>

					<p>For GPS assistance use: 789 Mariner Parkway Santa Cruz CA, 95062</p>

					<p>THE BOAT IS LOCATED ON DOCK “F”</p>
					<p>PARK IN <em>VISITOR</em> SPACES</p>

					<h3>Private Charters</h3>

					<p>NOTE: ALL “PRIVATE CHARTERS” MAY PROCEED DIRECTLY TO BOARDING.</p>

					<p>PLEASE ALLOW EXTRA TIME ON WEEKENDS AND HOLIDAYS.</p>
					<p class="b">We CANNOT wait for latecomers</p>

					<p><a href="/images/maptofreeway.jpg" "Map to Freeway" target="_blank">Map</a> for going from Freeways directly to our boat</p>

					<p class="b">CALL (831) 427-0230 FOR FURTHER ASSISTANCE</p>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<?php $__env->appendSection(); ?>
<?php echo $__env->make('layouts.frontend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>