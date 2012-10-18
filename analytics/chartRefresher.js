var chartRefresher = (function() {
	
	"use strict";
	
	//var profileId = 60602564; //for preciouslives
	var profileId = 59206021 //for penyopal
	var clientId = '388951243555.apps.googleusercontent.com';
	var apiKey = 'AIzaSyBdfXXjxSNBi40cN9gX5N5Pmsx6Jic94G0';
	var scopes = 'https://www.googleapis.com/auth/analytics.readonly';

	function loadAnalyticsClient() {
		progressBar.setWidth('40%');
		console.log("loading api");
		gapi.client.setApiKey(apiKey);
		console.log("set api key");
		gapi.auth.authorize({
			client_id: clientId,
			scope: scopes,
			immediate: false
		}, function(authResult) {
			progressBar.setWidth('80%');
			if (!authResult) {
				alert("Error user was not authenticated:")
			}
			gapi.client.load('analytics', 'v3', function() {
				progressBar.setWidth('100%');
				progressBar.hide();
				console.log("analytics loaded");
				chartRefresher.refreshChart();
			});
		});
	}
	
	function queryVisitors(date) {
		console.log("querying visitors on date: " + date);
		gapi.client.analytics.data.ga.get({
			'ids': 'ga:' + profileId,
			'start-date': date,
			'end-date': date,
			'metrics': 'ga:visitors',
			'prettyPrint': true
		}).execute(function(result) {
			if (result.error) {
				alert("There has been an error with the visitors query: " + result.message);
			} else {
				console.log("query visitors returned data:");
				console.log(result);
				chartData.addData(result);
			}
		});
	}


	function queryEvents(date) {
		console.log("querying events on date: " + date);
		gapi.client.analytics.data.ga.get({
			'ids': 'ga:' + profileId,
			'start-date': date,
			'end-date': date,
			'sort': 'ga:eventAction',
			'dimensions': 'ga:eventAction',
			'metrics': 'ga:uniqueEvents',
			'prettyPrint': true
		}).execute(function(result) {
			if (result.error) {
				alert("There has been an error with the events query: " + result.message);
			} else {
				console.log("query events returned data:");
				console.log(result);
				chartData.addData(result);
			}
		});
	}
	function printResults(results) {
		if (results.rows && results.rows.length) {
			console.log('Profile Name: ', results.profileInfo.profileName);
			console.log('Total Visits: ', results.rows[0][0]);
		} else {
			console.log('No results found');
		}
	}
	
	function grabAnalyticsData() {
		var startdate = new Date();
		startdate.setDate(startdate.getDate() - 8);
		var wg = new Date();
		wg.setDate(startdate.getDate());
		
		for (var i = 0; i < 7; i++) {
			wg.setDate(wg.getDate() + 1);
			var date = wg.getFullYear();
			if ((wg.getMonth() + 1) < 10) {
				date += "-0" + (wg.getMonth() + 1);
			}
			else {
				date += "-" + (wg.getMonth() + 1);	
			}
			date += "-" + wg.getDate();
			queryEvents(date);
		}
		
		setTimeout(function () {grabVisitorData(startdate)}, 1000);
	}
	
	function grabVisitorData(wg) {
		for (var i = 0; i < 7; i++) {
			wg.setDate(wg.getDate() + 1);
			var date = wg.getFullYear();
			if ((wg.getMonth() + 1) < 10) {
				date += "-0" + (wg.getMonth() + 1);
			}
			else {
				date += "-" + (wg.getMonth() + 1);	
			}
			date += "-" + wg.getDate();
			queryVisitors(date);
		}
	}
	
	return {
		load: function() {
			loadAnalyticsClient();
		},
		refreshChart: function() {
			grabAnalyticsData();
		}
	};
})();