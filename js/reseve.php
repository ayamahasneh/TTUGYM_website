<body>
  <h1>Activities</h1>
  <ul id="activities"></ul>
  <h2>Slots</h2>
  <ul id="slots"></ul>

  <script>
    const activitiesList = document.getElementById('activities');
    const slotsList = document.getElementById('slots');

    fetch('/api/activities')
      .then(response => response.json())
      .then(activities => {
        activities.forEach(activity => {
          const activityItem = document.createElement('li');
          activityItem.textContent = activity.name;
          activityItem.addEventListener('click', () => {
            fetch(`/api/slots/${activity.id}`)
              .then(response => response.json())
              .then(slots => {
                slotsList.innerHTML = '';
                slots.forEach(slot => {
                  const slotItem = document.createElement('li');
                  slotItem.textContent = `${slot.startTime} (${slot.isReserved ? 'Reserved' : 'Available'})`;
                  slotsList.appendChild(slotItem);
                });
              });
          });
          activitiesList.appendChild(activityItem);
        });
      });
  </script><body>
  <h1>Activities</h1>
  <ul id="activities"></ul>
  <h2>Slots</h2>
  <ul id="slots"></ul>

  <script>
    const activitiesList = document.getElementById('activities');
    const slotsList = document.getElementById('slots');

    fetch('/api/activities')
      .then(response => response.json())
      .then(activities => {
        activities.forEach(activity => {
          const activityItem = document.createElement('li');
          activityItem.textContent = activity.name;
          activityItem.addEventListener('click', () => {
            fetch(`/api/slots/${activity.id}`)
              .then(response => response.json())
              .then(slots => {
                slotsList.innerHTML = '';
                slots.forEach(slot => {
                  const slotItem = document.createElement('li');
                  slotItem.textContent = `${slot.startTime} (${slot.isReserved ? 'Reserved' : 'Available'})`;
                  slotsList.appendChild(slotItem);
                });
              });
          });
          activitiesList.appendChild(activityItem);
        });
      });
  </script>