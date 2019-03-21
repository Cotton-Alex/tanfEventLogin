



SELECT TOP 1000 R.[OneTimeEventRegistrantID]
      ,R.[TANFOneTimeEventManagementID]
      ,N.[EventName]
      ,N.[EventDate]
      ,R.[RegistrantID]
      ,P.[FirstName]
      ,P.[LastName]
      ,R.[Attended]
  FROM [beta_torresmartinez].[TANFOneTimeEventManagementModule].[OneTimeEventRegistrant] R
  JOIN [beta_torresmartinez].[PersonModule].[Person] P
  ON R.[RegistrantID] = P.[PersonID]
  JOIN [beta_torresmartinez].[TANFOneTimeEventManagementModule].[TANFOneTimeEventManagement] N
  ON R.[TANFOneTimeEventManagementID] = N.[TANFOneTimeEventManagementID]
  ORDER BY [OneTimeEventRegistrantID] DESC
