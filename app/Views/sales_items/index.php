<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
<section class="content">
<div class="container-fluid">

<div class="card">

<!-- HEADER -->
<div class="card-header">
<h3 class="card-title">Sales Transactions</h3>
</div>

<div class="card-body">

<?php if(session()->getFlashdata('msg')): ?>
<div class="alert alert-info">
<?= session()->getFlashdata('msg') ?>
</div>
<?php endif; ?>

<!-- SELECT TRANSACTION -->
<form method="get" action="<?= base_url('sales_items') ?>">
<select name="sale_id" class="form-control mb-3" onchange="this.form.submit()">

<option value="">Select Transaction Record</option>

<?php foreach($salesList as $s): ?>
<option value="<?= $s['id'] ?>"
<?= ($activeSale == $s['id']) ? 'selected' : '' ?>>

Transaction #<?= $s['id'] ?> - 
<?= date('M d, Y h:i A', strtotime($s['date'])) ?>

<?php if(!empty($s['created_at'])): ?>
(<?= date('h:i A', strtotime($s['created_at'])) ?>)
<?php endif; ?>

</option>
<?php endforeach; ?>

</select>
</form>

<!-- ADD ITEM (CART INPUT) -->
<form method="post" action="<?= base_url('sales_items/save') ?>">
<?= csrf_field() ?>

<input type="hidden" name="sale_id" value="<?= $activeSale ?>">

<div class="row mb-3">

<div class="col-md-6">
<select name="product_id" class="form-control">
<?php foreach($products as $p): ?>
<option value="<?= $p['id'] ?>">
<?= $p['name'] ?> - ₱<?= number_format($p['price'],2) ?>
</option>
<?php endforeach; ?>
</select>
</div>

<div class="col-md-2">
<input type="number" name="quantity" class="form-control" value="1" min="1">
</div>

<div class="col-md-2">
<button class="btn btn-primary w-100">
Add Item
</button>
</div>

</div>
</form>

<!-- FINALIZE TRANSACTION -->
<form method="post" action="<?= base_url('sales/checkout') ?>">
<?= csrf_field() ?>
<input type="hidden" name="sale_id" value="<?= $activeSale ?>">

<button class="btn btn-success mb-3">
Complete Transaction
</button>
</form>

<!-- ITEMS TABLE -->
<table class="table table-bordered">

<thead>
<tr>
<th>#</th>
<th>Product</th>
<th>Quantity</th>
<th>Total</th>
<th>Action</th>
</tr>
</thead>

<tbody>

<?php if(!empty($salesItems)): ?>
<?php foreach($salesItems as $item): ?>
<tr>

<td><?= $item['id'] ?></td>
<td><?= $item['name'] ?></td>
<td><?= $item['quantity'] ?></td>
<td>₱<?= number_format($item['subtotal'],2) ?></td>

<td>
<form method="post" action="<?= base_url('sales_items/delete') ?>">
<?= csrf_field() ?>
<input type="hidden" name="id" value="<?= $item['id'] ?>">
<button class="btn btn-danger btn-sm">
Remove
</button>
</form>
</td>

</tr>
<?php endforeach; ?>
<?php endif; ?>

</tbody>

</table>

</div>
</div>

</div>
</section>
</div>

<?= $this->endSection() ?>