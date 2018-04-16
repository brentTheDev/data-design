<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Data Design Project</title>
	</head>
	<body>

	<h1>Data Design Project</h1>

		<h2>User Persona:</h2>
			<img src="./jl-profile.jpg" alt = "Jane Locke, on travel through South America.">
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
			<p>As a user, Jane would like to add a newly released album to her wishlist.</p>

		<h2>Use Case:</h2>
			<p><strong>Title:</strong> Adding Sango's latest album to her wishlist.</p>
			<p><strong>Description:</strong> Jane wants to add Sango's latest album to the wishlist on her Bandcamp Fan account.</p>
			<p><strong>Name of user &amp; their role:</strong> Jane; music lover who enjoys purchasing her favorite artists' music via the Internet.</p>
			<p><strong>Usage preconditions:</strong> Must have Bandcamp account and logged in.</p>
			<p><strong>Usage postconditions:</strong> Artist is saved to wishlist and she can view on her wishlist page.</p>
			<p><strong>Interaction flow:</strong></p>
				<ul>
					<li>Jane enters sango.bandcamp.com into her web browser.</li>
					<li>Server returns Sango's main Bandcamp page.</li>
					<li>Jane clicks on "Wishlist" link on Sango's Bandcamp page. Heart icon next to "Wishlist" is empty</li>
					<li>Server completes request to add artist to wishlist.</li>
					<li>Jane sees that the heart icon next to artist name is now red and reads "In Wishlist" to notify her that the artist is in the wishlist of her Fan account.</li>
					<li>Server is displaying same album page with the colored icon and added link that reads "In Wishlist"</li>
					<li>Jane wants to see her wishlist and clicks a link next to "In Wishlist" which is labeled "view". </li>
					<li>Server loads Jane's wishlist page for her Bandcamp Fan account.</li>
					<li>Jane is able to see all newly added artist on her wishlist</li>
				</ul>
			<p><strong>Frequency of Use:</strong> Twice a week</p>

			<h2>Conceptual Model</h2>
				<h3>Entities &amp; Attributes:</h3>
					<p><strong>ARTIST:</strong>
						<ul>
							<li>artistId (primary key)</li>
							<li>artistGenre</li>
							<li>artistName</li>
						</ul>
					<p><strong>FAN:</strong>
						<ul>
							<li>fanId (primary key)</li>
							<li>fanActivationToken (for Account verification)</li>
							<li>fanEmail</li>
							<li>fanHash (for account password)</li>
							<li>fanUsername</li>
						</ul>
					<p><strong>WISHLIST:</strong>
						<ul>
							<li>wishlistArtistId (foreign key)</li>
							<li>wishlistFanId (foreign key)</li>
						</ul>
				<h3>Relations</h3>
					<ul>
						<li>One wishlist may only belong to 1 fan (1 to 1)</li>
						<li>Many artists may be on many wishlists. (m to n)</li>
					</ul>
			<h2>Entity Relationship Diagram</h2>
				<img src = "./data-design-erd.svg" alt = "Data Design ERD">
	</body>
</html>