<?= $this->extend('Template/index'); ?>
<?= $this->section('content'); ?>

<!--end::Row-->
<?= $this->endSection('content'); ?>
<?= $this->section('script'); ?>
<!-- apexcharts -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"
    integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8=" crossorigin="anonymous"></script>
<!-- ChartJS -->
<script>
// NOTICE!! DO NOT USE ANY OF THIS JAVASCRIPT
// IT'S ALL JUST JUNK FOR DEMO
// ++++++++++++++++++++++++++++++++++++++++++

sales_chart.render();
</script>
<?= $this->endSection('script'); ?>