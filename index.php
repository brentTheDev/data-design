<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Data Design Project</title>
	</head>
	<body>

	<h1>Data Design Project</h1>

		<h2>User Persona:</h2>
			<img src="./jlProfile.jpg" alt = "Jane Locke, on travel through South America.">
			<ul>
				<li><strong>Name:</strong> Jane Locke</li>
				<li><strong>Age:</strong> 23</li>
				<li><strong>Gender:</strong> Female</li>
				<li><strong>Ethnicity:</strong> Mixed Race</li>
				<li><strong>Occupation:</strong> Tech Intern/Grad Student</li>
				<li><strong>Technology:</strong> <em>Phone</em>; Samsung Galaxy S8. <em>Laptop</em>; Microsoft Surface Book. <em>OS</em>: Windows 10 Pro</li>
				<li><strong>Attitude:</strong> Likes to leave comments about latest releases, prefers PayPal payment, enjoys hearing similar artists/genres</li>
				<li><strong>Needs/Goals/Features:</strong></li>
					<ul>
						<li>Ability to leave reviews/comments on new releases</li>
						<li>See others who purchased the album in order to connect with other fans.</li>
						<li>Wants to preview music before making purchase</li>
					</ul>
				<li><strong>Frustrations:</strong></li>
					<ul>
						<li>Can't link account with Google</li>
						<li>Can't pay with Bitcoin</li>
					</ul>
			</ul>

		<h2>User Story:</h2>
			<p>As a user, Jane would like to sign into Bandcamp via Google account</p>

		<h2>Use Case:</h2>
			<p><strong>Title:</strong> Signing into Sango's Bandcamp page with a Google account.</p>
			<p><strong>Description:</strong> Jane wants to sign into Sango's Bandcamp page with her Google account so that she doesn't have to create a new user account with Bandcamp.</p>
			<p><strong>Name of user &amp; their role:</strong> Jane; music lover who enjoys purchasing her favorite artists' music via the Internet.</p>
			<p><strong>Usage preconditions:</strong> Must have Google account, must be a new user to Bandcamp</p>
			<p><strong>Usage postconditions:</strong> Bandcamp account is linked to Google account, ability to sign in with Google account.</p>
			<p><strong>Interaction flow:</strong></p>
				<ul>
					<li>Jane enters sango.bandcamp.com into her web browser.</li>
					<li>Server returns Sango's main Bandcamp page.</li>
					<li>Jane clicks the "Sign In" link on Sango's Bandcamp page.</li>
					<li>Server returns a "User Sign In" page.</li>
					<li>Jane sees an option to sign in via Google and clicks button.</li>
					<li>Server returns a page to verify the Google authentication.</li>
					<li>Jane clicks button to confirm that she wants Google to authorize Bandcamp to access her data.</li>
					<li>Server completes task, authorizes the connection between Google and Bandcamp, and returns verification page.</li>
					<li>Jane is now logged into Bandcamp via Google account.</li>
				</ul>
			<p><strong>Frequency of Use:</strong> Twice a week</p>

			<h2>Conceptual Model</h2>
				<h3>Entities &amp; Attributes:</h3>
					<p><strong>ARTIST:</strong>
						<ul>
							<li>artistId (primary key)</li>
							<li>artistName</li>
							<li>artistAlbumTitle</li>
							<li>artistTrackTitle</li>
							<li>artistGenre</li>
							<li>artistMusicFormat</li>
						</ul>
					<p><strong>FAN:</strong>
						<ul>
							<li>fanId (primary key)</li>
							<li>fanActivationToken (for account verification)</li>
							<li>fanUsername</li>
							<li>fanEmail</li>
							<li>fanHash (for account password)</li>
							<li>fanItemId (foreign key)</li>
						</ul>
					<p><strong>ITEM:</strong>
						<ul>
							<li>itemID (primary key)</li>
							<li>itemArtistID (foreign key)</li>
							<li>itemPrice</li>
						</ul>
					<p><strong>SHOPPINGCART:</strong>
						<ul>
							<li>shoppingCartFanId (foreign key)</li>
							<li>shoppingCartItemId (foreign key)</li>
						</ul>
					<p><strong>WISHLIST:</strong>
						<ul>
							<li>wishlistFanId (foreign key)</li>
							<li>wishlistArtistId (foreign key)</li>
						</ul>
				<h3>Relations</h3>
					<ul>
						<li>One shopping cart may only belong to 1 fan (1 to 1)</li>
						<li>One wishlist may only belong to 1 fan (1 to 1)</li>
						<li>Many items may belong in many shopping carts (m to n)</li>
						<li>Many artists may be on many wishlists. (m to n)</li>
						<li>Many artists sell many items (m to n)</li>
						<li>Many fans may own many items - (m to n)</li>
					</ul>
			<h2>Entity Relationship Diagram</h2>
				<img src = "./data-design-ERD.svg" alt = "Data Design ERD">
	</body>
</html>