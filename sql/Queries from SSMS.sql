
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


SELECT P.[LastName]
    ,P.[FirstName]
    ,S.[PersonID]
    ,H.[HouseholdID]
    FROM [beta_torresmartinez].[PersonModule].[Person] P
    JOIN [beta_torresmartinez].[PersonSSNModule].[Person] S
    ON P.[PersonID] = S.[PersonID]
    JOIN [beta_torresmartinez].[HouseholdModule].[HouseholdMember] H
    ON P.[PersonID] = H.[PersonID]
    WHERE RIGHT(SSN,4) =


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


-- INSERT STATEMENT USED
INSERT INTO [beta_torresmartinez].[TANFOneTimeEventManagementModule].[OneTimeEventRegistrant] (TANFOneTimeEventManagementID, RegistrantID, Attended) 
VALUES (19, 24, 1);



-- MULTI SESSION EVENT =========================================================

-- UPDATE MULTI SESSION EVENT WITH TODAY'S DATE
INSERT INTO [beta_torresmartinez].[TANFMultipleSessionEventModule].[MultipleSessionEventSession] (TANFMultipleSessionEventID, StartDate) 
VALUES (11, GETDATE());



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




-- CHECK SESSION ATTENDEE TABLE ================================================

-- SINGLE SESSION
SELECT TOP 1000 [OneTimeEventRegistrantID]
      ,[TANFOneTimeEventManagementID]
      ,[RegistrantID]
      ,[Attended]
      ,[Notes]
      ,[Active]
  FROM [beta_torresmartinez].[TANFOneTimeEventManagementModule].[OneTimeEventRegistrant]
  ORDER BY [OneTimeEventRegistrantID] DESC


-- MULTI SESSION
SELECT TOP 1000 [MultipleSessionEventSessionAttendeeID]
      ,[MultipleSessionEventSessionID]
      ,[PersonID]
      ,[Attended]
      ,[Comment]
      ,[Active]
  FROM [beta_torresmartinez].[TANFMultipleSessionEventModule].[MultipleSessionEventSessionAttendee]
  ORDER BY [MultipleSessionEventSessionAttendeeID] DESC
