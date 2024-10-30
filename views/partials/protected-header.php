<header class="container">
	<hgroup>
		<h1><?= $h1 ?></h1>
		<p><?= $p ?></p>
	</hgroup>
	<div>
		<nav>
			<ul>

				<div>
					<details class="dropdown">
						<summary role="button" class="secondary">Theme</summary>
						<ul>
							<li>
								<a href="#" data-theme-switcher="auto">Auto</a>
							</li>
							<li>
								<a href="#" data-theme-switcher="light">Light</a>
							</li>
							<li>
								<a href="#" data-theme-switcher="dark">Dark</a>
							</li>
						</ul>
					</details>
				</div>

				<li><a href="/logout" class="contrast">Log out</a></li>


			</ul>
		</nav>
	</div>
</header>