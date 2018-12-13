
-- CLIENTS ===============================================

UPDATE [beta_torresmartinez].[PersonModule].[Person]
SET LastName = 'Phoenix'
WHERE (PersonID = 1)


SELECT TANFCaseID]
      ,[HouseholdID]
  FROM [beta_torresmartinez].[TANFCaseModule].[TANFCase]


SELECT [HouseholdMemberID]
      ,[HouseholdID]
      ,[PersonID]
  FROM [beta_torresmartinez].[HouseholdModule].[HouseholdMember]


SELECT [PersonID]
      ,[FirstName]
      ,[LastName]
  FROM [beta_torresmartinez].[PersonModule].[Person]


SELECT [PersonID]
      ,[SSN]
  FROM [beta_torresmartinez].[PersonSSNModule].[Person]



-- STAFF ===============================================

SELECT [StaffID]
      ,[FirstName]
      ,[LastName]
  FROM [beta_torresmartinez].[StaffModule].[Staff]



-- ONE TIME EVENT ==============================================================

SELECT [TANFOneTimeEventManagementID] 
      ,[EventName]
      ,[EventDate]
  FROM [beta_torresmartinez].[TANFOneTimeEventManagementModule].[TANFOneTimeEventManagement]


-- WRITE TO THIS ONE
SELECT [OneTimeEventRegistrantID]
      ,[TANFOneTimeEventManagementID]
      ,[RegistrantID]
      ,[Attended]
  FROM [beta_torresmartinez].[TANFOneTimeEventManagementModule].[OneTimeEventRegistrant]



-- MULTI SESSION EVENT =========================================================

SELECT [TANFMultipleSessionEventID]
      ,[EventName]
      ,[SubmittedByID]
  FROM [beta_torresmartinez].[TANFMultipleSessionEventModule].[TANFMultipleSessionEvent]


SELECT [MultipleSessionEventSessionID]
      ,[TANFMultipleSessionEventID]
      ,[StartDate]
  FROM [beta_torresmartinez].[TANFMultipleSessionEventModule].[MultipleSessionEventSession]


-- WRITE TO THIS ONE
SELECT [MultipleSessionEventSessionAttendeeID]
      ,[MultipleSessionEventSessionID]
      ,[PersonID]
      ,[Attended]
  FROM [beta_torresmartinez].[TANFMultipleSessionEventModule].[MultipleSessionEventSessionAttendee]


