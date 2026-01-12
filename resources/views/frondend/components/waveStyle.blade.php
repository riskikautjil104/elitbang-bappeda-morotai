<style>
   @keyframes fadeInUp {
       from {
           opacity: 0;
           transform: translateY(30px);
       }
       to {
           opacity: 1;
           transform: translateY(0);
       }
   }

   .counter:hover {
       transform: translateY(-10px);
   }
</style>

<script>
   document.addEventListener('DOMContentLoaded', function() {
       const counters = document.querySelectorAll('.counterUp');
       const speed = 200; // The lower, the faster

       const animateCounter = (counter) => {
           const target = +counter.getAttribute('data-count');
           const count = +counter.innerText;
           const increment = target / speed;

           if (count < target) {
               counter.innerText = Math.ceil(count + increment);
               setTimeout(() => animateCounter(counter), 10);
           } else {
               counter.innerText = target;
           }
       };

       // Intersection Observer for triggering animation when in view
       const observer = new IntersectionObserver((entries) => {
           entries.forEach(entry => {
               if (entry.isIntersecting) {
                   const countersInView = entry.target.querySelectorAll('.counterUp');
                   countersInView.forEach(counter => {
                       if (counter.innerText === '0') {
                           animateCounter(counter);
                       }
                   });
                   observer.unobserve(entry.target);
               }
           });
       }, { threshold: 0.5 });

       const section = document.querySelector('.counter-section');
       if (section) {
           observer.observe(section);
       }
   });
</script>