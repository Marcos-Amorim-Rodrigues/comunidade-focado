let starOne = document.querySelector('#star0');
let starTwo = document.querySelector('#star1');
let starThree = document.querySelector('#star2');
let starFour = document.querySelector('#star3');
let starFive = document.querySelector('#star4');
function putRating(star) {
  starOne.children[0].attributes[0].value = '#FFF600';
  starOne.children[0].attributes[1].value = '#FFF600';
  starTwo.children[0].attributes[0].value = 'none';
  starTwo.children[0].attributes[1].value = 'currentColor';
  starThree.children[0].attributes[0].value = 'none';
  starThree.children[0].attributes[1].value = 'currentColor';
  starFour.children[0].attributes[0].value = 'none';
  starFour.children[0].attributes[1].value = 'currentColor';
  starFive.children[0].attributes[0].value = 'none';
  starFive.children[0].attributes[1].value = 'currentColor';
  switch (star) {
    case 'star1':
      starTwo.children[0].attributes[0].value = '#FFF600';
      starTwo.children[0].attributes[1].value = '#FFF600';
      starThree.children[0].attributes[0].value = 'none';
      starThree.children[0].attributes[1].value = 'currentColor';
      starFour.children[0].attributes[0].value = 'none';
      starFour.children[0].attributes[1].value = 'currentColor';
      starFive.children[0].attributes[0].value = 'none';
      starFive.children[0].attributes[1].value = 'currentColor';
      break;
    case 'star2':
      starTwo.children[0].attributes[0].value = '#FFF600';
      starTwo.children[0].attributes[1].value = '#FFF600';
      starThree.children[0].attributes[0].value = '#FFF600';
      starThree.children[0].attributes[1].value = '#FFF600';
      starFour.children[0].attributes[0].value = 'none';
      starFour.children[0].attributes[1].value = 'currentColor';
      starFive.children[0].attributes[0].value = 'none';
      starFive.children[0].attributes[1].value = 'currentColor';
      break;
    case 'star3':
      starTwo.children[0].attributes[0].value = '#FFF600';
      starTwo.children[0].attributes[1].value = '#FFF600';
      starThree.children[0].attributes[0].value = '#FFF600';
      starThree.children[0].attributes[1].value = '#FFF600';
      starFour.children[0].attributes[0].value = '#FFF600';
      starFour.children[0].attributes[1].value = '#FFF600';
      starFive.children[0].attributes[0].value = 'none';
      starFive.children[0].attributes[1].value = 'currentColor';
      break;
    case 'star4':
      starTwo.children[0].attributes[0].value = '#FFF600';
      starTwo.children[0].attributes[1].value = '#FFF600';
      starThree.children[0].attributes[0].value = '#FFF600';
      starThree.children[0].attributes[1].value = '#FFF600';
      starFour.children[0].attributes[0].value = '#FFF600';
      starFour.children[0].attributes[1].value = '#FFF600';
      starFive.children[0].attributes[0].value = '#FFF600';
      starFive.children[0].attributes[1].value = '#FFF600';
      break;
  }
}
