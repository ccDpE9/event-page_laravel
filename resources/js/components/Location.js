import React from 'react';

const Location = () => {
  return (
    <div className="location">
      <iframe
        src=`https://www.google.com/maps/embed/v1/place?key=${process.env.GOOGLE_MAPS_API}&q=Space+Needle,Seattle+WA`;
        width="100%"
        height="500"
        frameBorder="0"
        allowFullScreen
      ></iframe>
    </div>
  )
};


export default Location;

