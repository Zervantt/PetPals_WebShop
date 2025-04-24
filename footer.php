<?php
	$tanggal = date("Y");
?>

<style>
	.no-decoration{
		text-decoration: none;
	}

	@media (max-width: 576px) {
		.row.justify-content-center {
			flex-wrap: nowrap; /* Menghindari logo turun ke baris berikutnya */
			overflow-x: auto;  /* Menambahkan scroll jika terlalu banyak logo */
		}
	}
</style>

<footer>
	<div class="container-fluid align-items-center" style="margin-top:20px;">
		<footer class="text-center">
			<hr>
			<div class="container-fluid text-dark mb-3">
				<div class="container">
					<h5 class="text-center mb-4">Temui Kami</h5>
					<div class="row justify-content-center">
						<div class="col-auto d-flex justify-content-center mb-2">
							<a class="text-danger no-decoration" href="https://www.instagram.com/petpalsshop_id/">
								<i class="fab fa-instagram fs-4"></i>
							</a>
						</div>
						<div class="col-auto d-flex justify-content-center mb-2">
							<a class="text-black no-decoration" href="https://www.tiktok.com/@petpalsshop?_t=8iCa4rTuNPj&_r=1">
								<i class="fab fa-tiktok fs-4"></i>
							</a>
						</div>
						<div class="col-auto d-flex justify-content-center mb-2">
							<a class="text-success no-decoration" href="https://wa.me/628118867399">
								<i class="fab fa-whatsapp fs-4"></i>
							</a>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-12 py-2">
                Copyright © <?php echo $tanggal?> All Right Reserved Pet Pals Shop
                <br><br>
			</div>
		</footer>
	</div>
</footer>