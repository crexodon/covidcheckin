document.getElementById('verlauf').addEventListener('click', function() {
    document.querySelector('.bg-modal').style.display = 'flex';
    document.querySelector('.slider').style.display = 'none';
})
  
document.querySelector('.close').addEventListener('click', function(){
    document.querySelector('.bg-modal').style.display = 'none';
    document.querySelector('.slider').style.display = 'flex';
})