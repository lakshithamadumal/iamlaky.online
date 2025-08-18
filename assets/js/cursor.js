//cursor
document.addEventListener('DOMContentLoaded', function () {
  const cursor = document.querySelector('.cursor');
  const follower = document.querySelector('.cursor-follower');
  const elements = document.querySelectorAll('*'); // Select all elements

  let posX = 0, posY = 0;
  let mouseX = 0, mouseY = 0;

  // Mouse move event
  document.addEventListener('mousemove', function (e) {
    mouseX = e.clientX;
    mouseY = e.clientY;
  });

  // Animation loop
  function updateCursor() {
    // Main cursor (dot)
    posX += (mouseX - posX) / 9;
    posY += (mouseY - posY) / 9;

    cursor.style.left = mouseX + 'px';
    cursor.style.top = mouseY + 'px';

    // Follower cursor (circle)
    follower.style.left = posX + 'px';
    follower.style.top = posY + 'px';

    requestAnimationFrame(updateCursor);
  }

  updateCursor();

  // Hover effects
  elements.forEach(element => {
    element.addEventListener('mouseenter', () => {
      cursor.classList.add('active');
      follower.classList.add('active');
    });

    element.addEventListener('mouseleave', () => {
      cursor.classList.remove('active');
      follower.classList.remove('active');
    });
  });
});