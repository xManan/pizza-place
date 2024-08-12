{
	description = "laravel, php 8.3";

	inputs = {
		nixpkgs.url = "github:nixos/nixpkgs?ref=nixos-unstable";
	};

	outputs = { self, nixpkgs }: 
	let
		system = "x86_64-linux";
		pkgs = nixpkgs.legacyPackages.${system};
	in
	{
		devShells.${system}.default = 
			pkgs.mkShell
			{
				buildInputs = [
					pkgs.php
					pkgs.php83Packages.composer
					pkgs.nodejs_22
				];
			};

			shellHook = ''
				echo "Laravel dev environment"
			'';
	};
}
