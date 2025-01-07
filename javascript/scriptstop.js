// Create the "Back to Top" button
let topButton = document.createElement('button');
topButton.innerText = '↑';
topButton.id = 'top-btn';
document.body.appendChild(topButton);

// Show the button when scrolling down
window.onscroll = () => {
   if (window.scrollY > 200) {
      topButton.style.display = 'block';
   } else {
      topButton.style.display = 'none';
   }
};

// Scroll to the top when the button is clicked
topButton.onclick = () => {
   window.scrollTo({
      top: 0,
      behavior: 'smooth'
   });
};
