
<style>
    body {
	margin: 0;
	height: 100vh;
	align-items: center;
	justify-content: center;
	background: linear-gradient(to right bottom, gold, chocolate);
}

.nave ul {
	list-style-type: none;
	padding: 0;
}

.nave ul li {
	font-size: 40px;
	font-family: sans-serif;
	background-color: white;
	border: 2px solid black;
	letter-spacing: 0.1em;
	width: 6em;
	height: 1.5em;
	line-height: 1.5em;
	position: relative;
	overflow: hidden;
	margin: 0.5em;
	cursor: pointer;
}

.nave ul li span {
	color: white;
	mix-blend-mode: difference;
}

.nave ul li::before {
	content: '';
	position: absolute;
	width: 1.5em;
	height: inherit;
	background-color: black;
	border-radius: 50%;
	top: 0;
	left: -0.75em;
	transition: 0.5s ease-out;
}

.nave ul li:hover::before {
	transform: scale(7);
}
a{
    text-decoration: none
}

</style>

<div>
    <nav class="nave">
        <ul>
            <li><span><a class="" href="{{route("categories.index")}}">Catégories</a></span></li>
            <li><span><a class="" href="{{route("servants.index")}}">Serveurs</a></span></li>
            <li><span><a class="" href="{{route("tables.index")}}">Tables</a></span></li>
            <li><span><a class="" href="{{route("menus.index")}}">Menu</a></span></li>
        </ul>
    </nav>
</div>
