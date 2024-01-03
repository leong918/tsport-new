/* global google */
/**
 * --------------------------------------------------------------------------
 * CoreUI Boostrap Admin Template (4.3.0): google-maps.js
 * License (https://coreui.io/pro/license)
 * --------------------------------------------------------------------------
 */

const initMap = () => {
  const locations = [
    {
      lat: 37.431_489,
      lng: -122.163_719,
      label: 'S',
      draggable: false,
      title: 'Stanford',
      www: 'https://www.stanford.edu/'
    },
    {
      lat: 37.394_694,
      lng: -122.150_333,
      label: 'T',
      draggable: false,
      title: 'Tesla',
      www: 'https://www.tesla.com/'
    },
    {
      lat: 37.331_681,
      lng: -122.0301,
      label: 'A',
      draggable: false,
      title: 'Apple',
      www: 'https://www.apple.com/'
    },
    {
      lat: 37.484_722,
      lng: -122.148_333,
      label: 'F',
      draggable: false,
      title: 'Facebook',
      www: 'https://www.facebook.com/'
    }
  ]
  const map = new google.maps.Map(document.getElementById('map'), {
    center: {
      lat: 37.431_489,
      lng: -122.163_719
    },
    zoom: 11
  })
  locations.map(location => {
    const contentString = `<a href="${location.www}" target="_blank"><strong>${location.title}</strong></a>`
    const infoWindow = new google.maps.InfoWindow({
      content: contentString,
      maxWidth: 200
    })
    const marker = new google.maps.Marker({
      position: location,
      label: location.label,
      map,
      title: location.title,
      contentString
    })
    marker.addListener('click', () => {
      infoWindow.open(map, marker)
    })
    return marker
  })
}

if (window.google && window.google.maps) {
  initMap()
}
