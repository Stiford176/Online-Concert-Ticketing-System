<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer</title>
</head>
<body>
<footer>
        <div class="left-footer">
            <h3><span class="text-green">OCTA - GLOWFEST:</span> NEON NIGHTS</h3>
            <h3>BE PART OF THE NEON REVOLUTION!</h3>
        </div>
        <ul class = "ul-soc">
            <li class = "li-soc"> 
                <a class ="soc" href="#" style="--clr0: #ff0050; --clr1: #990030; --clr2: #ff266a">
                    <i class="fa-brands fa-tiktok"></i>
                </a>
            </li>
            <li class = "li-soc"> 
                <a class ="soc" href="#" style="--clr0: #4267b2; --clr1: #283e6b; --clr2: #5a7cc2">
                    <i class="fa-brands fa-facebook-f"></i>
                </a>
            </li>
            <li class = "li-soc"> 
                <a class ="soc" href="#" style="--clr0: #cd201f; --clr1: #7b1313; --clr2: #e03635">
                    <i class="fa-brands fa-youtube"></i>
                </a>
            </li>
            <li class = "li-soc"> 
                <a class ="soc" href="#" style="--clr0: #1da1f2; --clr1: #09639a; --clr2: #3faff4">
                    <i class="fa-brands fa-twitter"></i>
                </a>
            </li>
        </ul>

        <div class="right-footer">
            <h3>Developed by: OCTA</h3>
        </div>
    </footer>
</body>
</html>

<style>
    @import url(https://use.fontawesome.com/releases/v6.4.2/css/all.css);
    footer {
  width: 100%;
  height: 150px;
  background-color: black;
  display: flex;
  justify-content: space-between;
  box-sizing: border-box;
  font-family: helvetica;
}

.text-green {
  color: #00ff7f;
}

.left-footer,
.right-footer {
  padding: 0 20px;
  font-size: 12px;
}

footer img {
  background-color: black;
  width: 20%;
  height: 20%;
}

.left-footer {
  color: white;
  width: 50%;
  height: auto;
  text-align: left;
}

.right-footer {
  color: white;
  width: 50%;
  height: auto;
  text-align: right;
}

.ul-soc {
  display: flex;
  gap: 100px;
}
.li-soc {
  list-style: none;
}
.fa-brands {
  font-size: 30px;
  color: #15e26b;
  line-height: 40px;
  transition: 0.5s;
}
.soc {
  position: relative;
  display: block;
  width: 40px;
  height: 40px;
  background: #000000;
  text-align: center;
  transform: perspective(1000px) rotate(-30deg) skew(25deg) translate(0, 0);
  transition: 0.5s;
  transition-timing-function: linear;
  box-shadow: -20px 20px 10px rgba(0, 0, 0, 0.5);
}
.soc:before {
  content: "";
  position: absolute;
  top: 10px;
  left: -20px;
  height: 100%;
  width: 20px;
  background: #000000;
  transition: 0.5s;
  transform: rotate(0deg) skewY(-45deg);
}
.soc:after {
  content: "";
  position: absolute;
  bottom: -20px;
  left: -10px;
  height: 20px;
  width: 100%;
  background: #000000;
  transition: 0.85s;
  transform: rotate(0deg) skewX(-45deg);
}
.soc:hover {
  transform: perspective(1000px) rotate(-30deg) skew(25deg)
    translate(20px, -20px);
  box-shadow: -50px 50px 50px rgba(0, 0, 0, 0.5);
}
li:hover .fa-brands {
  color: #000000;
}
li:hover .soc {
  background: var(--clr0);
}
li:hover .soc:before {
  background: var(--clr1);
}
li:hover .soc:after {
  background: var(--clr2);
}
</style>